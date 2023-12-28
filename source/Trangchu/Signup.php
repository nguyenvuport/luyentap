<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title> LAPTOP STORE </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' type='text/css' media='screen' href='Signup.css'>
    <script src='main.js'></script>
</head>
<body>
<?php
        $dktenndn=isset($_POST['dktendn']) ? $_POST['dktendn']:'';
        $dkhoten=isset($_POST['dkhoten']) ? $_POST['dkhoten']:'';
        $dksdt=isset($_POST['dksdt']) ? $_POST['dksdt']:'';
        $dkpass=isset($_POST['dkpass']) ? $_POST['dkpass']:'';
        $xmpass=isset($_POST['xmpass']) ? $_POST['xmpass']:'';
        $tt=0;
        $lbdk='';
        $testtendn=true;
        $conn =new mysqli('localhost','root','','qllaptop');
        if($dktenndn!=''&&$dkhoten!=''&&$dksdt!=''&&$dkpass!=''&&$xmpass!='')
        {
            $kttk = "SELECT * FROM taikhoan";
            $tkdn = $conn->query($kttk);
            while ($row = $tkdn->fetch_assoc()) 
            {
                if($row['tendn']===$dktenndn)
                {
                    $testtendn=false;
                }
            }
            if($testtendn)
            {
                if($dkpass===$xmpass&&$dkpass!='')
                {
                    $sql = "INSERT INTO taikhoan(hoten,sdt,tendn,matkhau,trangthai) VALUES ('$dkhoten','$dksdt','$dktenndn','$dkpass','$tt')";
                    $result = $conn->query($sql);
                    if($result)
                    {
                        header('Location: /WebLapTop/source/Trangchu/Login.php');
                    }
                }elseif($dkpass!=$xmpass&&$dkpass!='')
                {
                    $lbdk='Mật khẩu cần giống nhau';
                }
            }else{
                $lbdk='Tên đăng nhập đã được sử dụng';
            }
            
        }elseif(($dktenndn==''||$dkhoten==''||$dksdt==''||$dkpass==''||$xmpass=='')&&isset($_POST['dk']))
        {
            $lbdk='Vui lòng điền đầy đủ thông tin!!!';
        }
?>
 <section class="home"> 
        <div class="form_container">
            <a href="Login.php" ><i class="fa-solid fa-xmark"></i></a>
    <!-- Login form -->
    <div class="form login_form">
                 <form method="post" id="dinhdang">
                     <h2>Đăng ký tài khoản </h2>
                     <label ><?php echo $lbdk ?></label>
                     <div class="input_box">
                         <input type="text" name="dkhoten" placeholder="Nhập Họ và Tên" value="<?php echo $dkhoten?>" required />
                         <i class="fa-solid fa-font"></i>
                     </div>

                     <div class="input_box">
                         <input type="text" name="dksdt" placeholder="Nhập Số điện thoại" value="<?php echo $dksdt?>" required />
                         <i class="fa-solid fa-phone"></i>
                     </div>

                     <div class="input_box">
                         <input type="text" name="dktendn" placeholder="Nhập Tên đăng nhập" value="<?php echo $dktenndn?>" required />
                         <i class="fa-solid fa-user"></i>
                     </div>
                     <div class="input_box">
                         <input type="password" name="dkpass" placeholder="Nhập mật khẩu " required />
                         <i class="fa-solid fa-lock"></i>
                         <i class="fa-regular fa-eye-slash"></i>
                     </div>
                     <div class="input_box">
                         <input type="password" name="xmpass" placeholder="Xác minh mật khẩu " required />
                         <i class="fa-solid fa-lock"></i>
                         <i class="fa-regular fa-eye-slash"></i>
                     </div>

                     <div class="option_field">
                         <span class="checkbox">
                             <input type="checkbox" id="check" name="">
                             <label for="check">Nhắc tôi</label>
                         </span>
                         <a href="#" class="forgot_pw">Quên mật khẩu?</a>
                     </div>

                     <button class="button">Đăng ký ngay</button>

                     <div class="login_signup">
                         Bạn đã có tài khoản ? 
                         <a href="Login.php" name="dk" id="signup">Đăng nhập</a>
                     </div>
                 </form>
             </div>

             
      </div>
    </section>

</body>
</html>