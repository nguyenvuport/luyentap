<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapTop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="ChiTietSP.css">
</head>
<body>
<?php
  $conn =new mysqli('localhost','root','','qllaptop');
?>

<div class="wrapper">
        <a href="trangchu.php" id="logo">
            <img src="hope.png" alt="logolaptop">
        </a>
        <div id="header">

            <div class="search-text">

                <form  method="post">
                <input type="text" name="txttimkiem" size="42px" placeholder="Tìm kiếm ...">
                <a href="" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></a>
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
                <li><a href=""><i class="fa-solid fa-gift"></i>  Khuyến mãi</a></li>
        </ul>
  </nav>
 </div>
  
  <div class="content" >
    <?php
            $masp = $_POST['masp'];
            $lb='';
            $sl=1;
            $sql = " SELECT * FROM sanpham Where masp ='".$masp."' ";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc())
            {
                if(isset($_POST['buy']))
                    {
                        $sl=$_POST['sl'];
                        $gia=$row['gia'];
                        $msp=$row['masp'];
                        if($sl<=$row['soluong'])
                        {
                            $spmua = "INSERT INTO spmua(masp,soluong,dongia,manguoidung) VALUES ('$msp','$sl','$gia','$uid')";
                            $mua= $conn->query($spmua);
                            if($mua)
                            {
                                $lb='Thêm vào giỏ hàng thành công !' ;
                            }
                        }else
                        {
                            $lb='Trong kho không đủ hàng';
                        }
                    }
                if($row['soluong']!=0)
                {
                    echo "
                    <table>
                        <tr>
                            <td >
                            <form method='post'>
                            <div class='sanpham'>
                                <div>
                                    <div >
                                        <img style='width:300px; height: 300px; ' <img src='".$row['hinhanh']."'>
                                    </div>
                                </div>
                                <div id='sl'>
                                    <div class='db'><p>Đã bán:".$row['daban']."</p></div>
                                <div>
                                    <input style='text-align: center;' type='text' name='sl' id='txtsl' value='".$sl."'>
                                </div>
                                    <div class='soluong'><p>Còn:".$row['soluong']."</p></div>
                                    <input type='text' name='masp' value='".$row['masp']."' hidden='true'>
                                </div>
                                <div id='mua'>
                                    <button type='submit' name='buy'> Thêm vào giỏ hàng </button>
                                </div>
                                <label style='font-size:16px; margin-top:15px; margin-left:20px; color:#660099; font-weight:600;'>".$lb."</label>
                            </div>
                        </form>
                            </td>
                            <td >
                            <div class='ttsp'>
                            <div id='tensp'>
                                <P>".$row['tensp']."</P>
                            </div>
                            <div id='mota'>
                                <P style='font-size:20px;'text-align:left;>".$row['ttsp']."</P>
                            </div>
                        <div id='gia'>
                            <p>".$row['gia']."đ</p>
                        </div>
                    </div>
                            </td>
                        </tr>
                    </table>
                    ";
                }elseif($row['soluong']==0)
                {
                    echo "
                <form method='post'>
                    <div class='sanpham'>
                        <div>
                        <div >
                            <img style='width:300px; height: 300px; ' <img src='/WebLapTop/source/image/".$row['hinhanh']."'>
                        </div>
                        </div>
                        <div id='sl'>
                            <div><p>Đã bán:".$row['daban']."</p></div>
                            <div>
                                <input style='text-align: center;' type='text' name='sl' id='txtsl' value=''>
                            </div>
                            <div><p>Còn:".$row['soluong']."</p></div>
                            <input type='text' name='masp' value='".$row['masp']."' hidden='true'>
                        </div>
                        <div id='mua'>
                            <p style='color:white;'>Hết hàng</>
                        </div>
                    </div>
                </form>
                        <div class='ttsp'>
                            <div id='tensp'>
                                <P>".$row['tensp']."</P>
                            </div>
                            <div id='mota'>
                                <P style='font-size:20px;'text-align:left;>".$row['ttsp']."</P>
                            </div>
                        <div id='gia'>
                            <p>".$row['gia']."</p>
                        </div>
                    </div>
                    ";
                }
            }
            
        ?>
    </div>


</body>
 </html>
