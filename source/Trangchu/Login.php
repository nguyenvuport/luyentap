<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title> LAPTOP STORE </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' type='text/css' media='screen' href='login.css'>
    <script src='main.js'></script>
</head>
<body>
<?php
        session_start();
        $tendn=isset($_POST['tendn']) ? $_POST['tendn']:'';
        $pass=isset($_POST['pass']) ? $_POST['pass']:'';
        $conn =new mysqli('localhost','root','','qllaptop');
        $kt=true;
        $lb='';
        if($tendn!=''&&$pass!='')
        {
            $thongtin= "SELECT * FROM taikhoan ";
            $ttkh=$conn->query($thongtin);
            $_SESSION['role'] = $row['role'];
            while ($row = $ttkh->fetch_assoc())
            {
                if($tendn===$row['tendn']&&$pass===$row['matkhau'])
                {

                    $kt=false;
                    $sql="UPDATE taikhoan SET trangthai='1' WHERE tendn='$tendn'";
                    $result = $conn->query($sql);
                    $_SESSION['role'] = $row['role'];
                    if($result)
                    {
                        header('Location: /WebLapTop/source/Trangchu/trangchu.php');
                    }
                }
            }
            if($kt)
                {
                    $lb='Tên đăng nhập hoặc mật khẩu không đúng!!!';
                }
            
        }elseif(($tendn==''||$pass=='')&&isset($_POST['dn']))
        {
            $lb='Vui lòng điền đầy đủ thông tin!!!';
        }
?>
 <section class="home"> 
        <div class="form_container">
            <a href="trangchu.php"><i class="fa-solid fa-xmark"></i></a>
    <!-- Login form -->
    <div class="form login_form">
                 <form method="post" id="dinhdang">
                     <h2>Đăng nhập</h2>

                     <label><?php echo $lb ?></label>

                     <div class="input_box">
                         <input type="text" name="tendn" placeholder="Nhập tên đăng nhập" required />
                         <i class="fa-solid fa-user"></i>
                     </div>
                     <div class="input_box">
                         <input type="password" name="pass" placeholder="Nhập mật khẩu của bạn" required />
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
                    
                     <button class="button" name="dn">Đăng nhập</button>

                     <div class="login_signup">
                         Bạn không co tài khoản ? 
                         <a href="Signup.php" id="signup">Đăng ký</a>
                     </div>
                 </form>
             </div>

             </div>
      </div>
    </section>

</body>
</html>