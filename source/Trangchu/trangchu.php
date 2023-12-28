<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapTop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="trangchu.css">
</head>
<body>
    <?php
    session_start();
         $conn =new mysqli('localhost','root','','qllaptop');
         $sql = "SELECT * FROM sanpham";
         $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
        $result = $conn->query($sql);
        $uid='';
        if(isset($_POST['search']))
        {
            $ndtk=$_POST['txtTimKiem'];
            if($ndtk!='')
            {
                $tk="INSERT INTO timkiem(nd,tttk) VALUES ('$ndtk','1')";
                $kqtk=$conn->query($tk);
                if($kqtk)
                {
                    header('Location: /WebLapTop/source/Trangchu/Timkiem.php');
                }
            }
        }

    ?>
    <div class="wrapper">
        <a href="trangchu.php" id="logo">
            <img src="hope.png" alt="logolaptop">
        </a>
        <div id="header">

            <div class="search-text">

                <form  method="post">
                <input type="text" name="txtTimKiem" size="42px" placeholder="Tìm kiếm ...">
                <a name="search" type="submit" class="search-btn" hidden="true"><i class="fa-solid fa-magnifying-glass"></i></a>
                <input type="submit" name="search" id="tim" value="Tìm" >
                </form>
            </div>

                <div class="btn-menu">
                <button class="hotline"><i class="fa-solid fa-phone-volume"></i> Hotline : 0123456789 </button>
                <button class="cart"><a href="Giohang.php"><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</a></button>
                <?php
                $dn="SELECT * FROM taikhoan";
                $trangthai=$conn->query($dn);
                $testdn=false;
                
                while($row = $trangthai->fetch_assoc())
                {
                    if($row['trangthai'])
                    {
                        $uid=$row['UID'];
                        $testdn=true;
                    }
                    
                    if($row['trangthai'])
                    {
                        $tendn=$row['tendn'];
                        if(isset($_POST['dx']))
                        {
                            $dx="UPDATE taikhoan SET trangthai='0' WHERE tendn='$tendn'";
                            $dangxuat=$conn->query($dx);
                            if($dangxuat)
                            {
                                header('Location: /WebLapTop/source/Trangchu/Login.php');
                            }
                        }
                    }
                    
                }
                if($testdn)
                {
                    echo"
                        <form method='post'>
                            <input type='text' name='uid' id='' value='".$uid."' hidden='true'>
                            <button id='dangnhap' type='submit' name='dx'><a><i class='fa-solid fa-circle-user'></i>Đăng xuất</a></button>
                        </form>
                    ";
                }else
                {
                    echo "
                        <button id='dangnhap' ><a href='Login.php' ><i class='fa-solid fa-circle-user'></i>Đăng nhập</a></button>
                    ";
                }
                ?>
                </div>
        </div>
    </div>
    <?php
       if ($role == "Admin") { 
               header('Location: /WebLapTop/source/Admin/Addpr.php');
     } else { ?>
        <div id="header-2">
        <nav class="container">
          <ul id="main-menu">
                <li style="color: #000077; margin-top:15px; margin-left:220px ;" > | </li>
                <li><a href="trangchu.php" class="btn-home"><i class="fa-solid fa-house"></i> Trang chủ </a></li>
                <li><a href=""><i class="fa-solid fa-circle-info"></i> Giới thiệu </a></li>
                <li><a href=""> <i class="fa-solid fa-star"></i>  Sản phẩm </a></li>
                <li><a><i class="fa-solid fa-gift"></i>  Khuyến mãi</a></li>
        </ul>
  </nav>
 </div>
    <?php } ?>

 <div class="content">
        <div class="anh">

        </div>
        <div class="noibat">
                <a href="BanNhieu.php"><i class="fa-sharp fa-solid fa-fire"></i> Hàng bán chạy nhất</a>
                <a href="HangMoi.php"><i class="fa-solid fa-bolt"></i> Hàng mới nhập</a>
        </div>
        <div class="main">
            <div class="menu">
            <h3><i class="fa-solid fa-bars"></i>DANH MỤC SẢN PHẨM</h3>
            <ul style="list-style-type: square;" class="ul-name">
                <li class="li_name" >Apple
                    <ul style="list-style-type: circle;">
                        <li><a href="BepGa.php"> MacBook</a></li>
                        <li><a href="BepTu.php"> MacBook</a></li>
                    </ul>
                </li>
                <li class="li_name">Dell
                    <ul style="list-style-type: circle;">
                        <li><a href="LoViSong.php"> Dell Vostro</a></li>
                        <li><a href="TuLanh.php"> Dell 2</a></li>
                    </ul>
                </li>
            </ul>
            </div>
            <!-- Phân trang -->
            <?php
            //TÌM TỔNG SỐ RECORDS
            $result = mysqli_query($conn, 'select count(masp) as total from sanpham');
            $row = mysqli_fetch_assoc($result);
            $total_records = $row['total'];
            //TÌM LIMIT VÀ CURRENT_PAGE
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 2;
            //TÍNH TOÁN TOTAL_PAGE VÀ START
            // tổng số trang
            $total_page = ceil($total_records / $limit);
             // Giới hạn current_page trong khoảng 1 đến total_page
            if ($current_page > $total_page){
            $current_page = $total_page;
            }
            else if ($current_page < 1){
            $current_page = 1;
            }
 
            // Tìm Start
            $start = ($current_page - 1) * $limit;
 
            // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
            // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
            $result = mysqli_query($conn, "SELECT * FROM sanpham LIMIT $start, $limit");
 
            ?>
            <!-- ---------- -->
            <div class="sp">
                    <div class="dssp">
                        <?php
                        while ($row = $result->fetch_assoc()) 
                        {
                            if($testdn)
                            {
                                echo"
                                    <form action='chitiet.php' method='post'>
                                        <div class='ttsp'>
                                        <img src='".$row['hinhanh']."' >
                                        <P style='color:#3366CC; font-weight: 600;'> ".$row['tensp']."</P>
                                        <p style='color:#FF6633; font-weight: 600;'>".number_format($row['gia'])."  VNĐ</p>
                                        <p><button style='font:white'; type='submit' name='' >Mua</button></p>
                                        <input type='text' name='masp' value='".$row['masp']."' hidden='true'>
                                        </div>
                                    </form>
                                    ";
                            }else{
                                echo"
                                    <form action='chitiet.php' method='post'>
                                        <div class='ttsp'>
                                        <img src='".$row['hinhanh']."' >
                                        <P>".$row['tensp']."</P>
                                        <p>".$row['gia']."VNĐ</p>
                                        <p><button  name='' ><a href='Login.php'>Mua</a></button></p>
                                        <input type='text' name='masp' value='".$row['masp']."' hidden='true'>
                                        </div>
                                    </form>
                                    ";
                            }
                            
                        }
                        // $conn->close();
                        ?>
                        
                    </div> 
                    <div class="phantrang">
       <?php
         // PHẦN HIỂN THỊ PHÂN TRANG
         // BƯỚC 7: HIỂN THỊ PHÂN TRANG

         // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
         if ($current_page > 1 && $total_page > 1){
             echo '<a class="prv" href="trangchu.php?page='.($current_page-1).'">Prev</a>';
         }

         // Lặp khoảng giữa
         for ($i = 1; $i <= $total_page; $i++){
             // Nếu là trang hiện tại thì hiển thị thẻ span
             // ngược lại hiển thị thẻ a
             if ($i == $current_page){
                 echo '<span style=" background-color: #63B8FF;color:white; ">'.$i.'</span>';
             }
             else{
                 echo '<a class="numberpage" href="trangchu.php?page='.$i.'">'.$i.'</a>';
             }
         }

         // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
         if ($current_page < $total_page && $total_page > 1){
             echo '<a class="next" href="trangchu.php?page='.($current_page+1).'">Next</a>';
         }
       ?>
  </div>       
            </div>
            
        </div>
        
  </div>
  
  <div class="phantrang">
       <?php
         // PHẦN HIỂN THỊ PHÂN TRANG
         // BƯỚC 7: HIỂN THỊ PHÂN TRANG

         // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
         if ($current_page > 1 && $total_page > 1){
             echo '<a class="prv" href="trangchu.php?page='.($current_page-1).'">Prev</a>';
         }

         // Lặp khoảng giữa
         for ($i = 1; $i <= $total_page; $i++){
             // Nếu là trang hiện tại thì hiển thị thẻ span
             // ngược lại hiển thị thẻ a
             if ($i == $current_page){
                 echo '<span style=" background-color: #63B8FF;color:white; ">'.$i.'</span>';
             }
             else{
                 echo '<a class="numberpage" href="trangchu.php?page='.$i.'">'.$i.'</a>';
             }
         }

         // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
         if ($current_page < $total_page && $total_page > 1){
             echo '<a class="next" href="trangchu.php?page='.($current_page+1).'">Next</a>';
         }
       ?>
  </div>


    
    <div class="info-3">
         <footer>
    <div class="info-1">
        <h2> Hỗ trợ dịch vụ </h2>
        <ul>
            <li> <a href="">Tra cứu đơn hàng </a> </li>
            <li> <a href="">Chính xác bảo mật </a> </li>
            <li> <a href="">Điều khoản mua bán </a> </li>
        </ul>

    </div>
        <div class="info-2">
        <h2> Thông tin liên hệ </h2>
        <ul>
            <li> <a href=""><i class="fa-brands fa-facebook"></i> Facebook </a> </li>
            <li> <a href=""><i class="fa-brands fa-twitter"></i> Twitter </a> </li>
            <li> <a href=""><i class="fa-brands fa-instagram"></i> Instagram</a> </li>
        </ul>

    </div>
    </footer>
        <p> Copyright 2019 © - Bản quyền thuộc về Laptopstore </p>
        <p> Điện thoại: (012) 345 6789. Email: laptopstore@laptop.com.vn.</p>
    </div>

</body>
</html>