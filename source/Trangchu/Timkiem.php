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
        $conn =new mysqli('localhost','root','','qllaptop');
        $ndtk = "SELECT * FROM timkiem";
        $laynd = $conn->query($ndtk);
        $nd=NULL;
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

 <div class="content">
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

            <?php
              while($row = $laynd->fetch_assoc())
                        {
                            if($row['tttk'])
                            {
                                $nd=$row['nd'];
                            }
                        }
                        
                        if($nd!=NULL)
                        {
                        $sql="SELECT * FROM sanpham WHERE tensp like '%$nd%'";
                        $result=$conn->query($sql);
                        if($result)
                        {
                            while ($row = $result->fetch_assoc()) 
                        {
                                if($testdn)
                            {
                                echo"
                                    <form action='ChiTietSP.php' method='post'>
                                        <div class='ttsp'>
                                        <img src='".$row['hinhanh']."' >
                                        <P>".$row['tensp']."</P>
                                        <p>".$row['gia']."</p>
                                        <p><button type='submit' name='' >Mua</button></p>
                                        <input type='text' name='masp' value='".$row['masp']."' hidden='true'>
                                        </div>
                                    </form>
                                    ";
                            }else{
                                echo"
                                    <form action='ChiTietSP.php' method='post'>
                                        <div class='ttsp'>
                                        <img src='".$row['hinhanh']."' >
                                        <P>".$row['tensp']."</P>
                                        <p>".$row['gia']."</p>
                                        <p><button  name='' ><a href='Login.php'>Mua</a></button></p>
                                        <input type='text' name='masp' value='".$row['masp']."' hidden='true'>
                                        </div>
                                    </form>
                                    ";
                            }
                            
                            
                            
                        }
                            $tttk="UPDATE timkiem SET tttk='0' WHERE tttk='1'";
                            $kqtttk=$conn->query($tttk);
                        }
                    }else{
                        echo"<div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br> 
                        <p style='font-size:25px;color:red;'>Bạn chưa nhập thông tin muốn tìm!!!</p></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br> 
                        <br>
                        <br>
                        <br>
                       
                        ";
                        
                    }
                        
                        // $conn->close();
            ?>

        </div>

</div>



</body>
</html>