<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapTop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Giohang.css">
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
                <button class="cart"><a href=""><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</a></button>
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
                            <button id='dangnhap' type='submit' name='dx'><i class='fa-solid fa-circle-user'></i>Đăng xuất</button>
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

 <div class="content">
        <div id="oder">
            <div class="table">
            <table style=" border-collapse: collapse; " >
                <tr>
                    <th style="width: 40px;
                                height: auto;">STT</th>
                    <th style="width: 300px;
                                height: auto;">Tên sản phẩm</th>
                    <th style="width: 300px;
                                height: auto;">Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                </tr>
                <?php

                    $sp_oder="SELECT * FROM spmua WHERE manguoidung='$uid' AND order_id='0'";
                    $sp=$conn->query($sp_oder);
                    $dem=0;
                    $thanhtien=0;
                    $tongtien=0;
                    if(isset($_POST['xoa']))
                        {
                            $idsp=isset($_POST['idxoa']) ? $_POST['idxoa']:'';
                            $xoa="DELETE FROM spmua WHERE id='$idsp'";
                            $kqxoa=$conn->query($xoa);
                            if($kqxoa)
                            {
                                header('Location: /WebLapTop/source/Trangchu/Giohang.php');
                            }
                        }
                    while($row = $sp->fetch_assoc())
                    {
                        $thanhtien=$row['dongia']*$row['soluong'];
                        $dem=$dem+1;
                        $masp=$row['masp'];
                        $ttsp="SELECT * FROM sanpham WHERE masp='$masp'";
                        $ifsp=$conn->query($ttsp);
                        while($rows= $ifsp->fetch_assoc())
                        {
                            echo "
                            <form method='post'>
                        <tr>
                            <td >".$dem."
                            <input type='text' name='idxoa' Style='width:20px' value='".$row['id']."' hidden='true'>
                                    </td>
                            <td style='width: 300px;
                                    height: auto;'>".$rows['tensp']."</td>
                            <td style='width: 300px;
                                    height: auto;'><img style='width:100px; height: 100px; ' <img src='".$rows['hinhanh']."'></td>
                            <td>".$row['dongia']."</td>
                            <td>".$row['soluong']."</td>
                            <td>".$thanhtien."</td>
                            <td><button type='submit' name='xoa'><i class='fa-solid fa-trash-can'></i> Xóa </button></td>
                        </tr>
                        </form>
                        ";
                        }
                    }
                        $tongtien=$tongtien+$thanhtien;
                        echo "
                        <tr>
                            <th style='width: 40px;
                                    height: auto;'>&nbsp;</th>
                            <th style='width: 300px;
                                    height: auto;'>Tổng tiền:</th>
                            <th style='width: 300px;
                                    height: auto;'>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>".$tongtien."</th>
                            <th>&nbsp;</th>
                        </tr>
                        
                        ";
                        
                ?>
            </table>
            </div>
            <!-- <div id="update">
                <button><a href="Giohang.php">Cập nhật</a></button>
            </div> -->
        </div>
        <div >
            <br>
            <br>
            <hr size="2px" width="95%" >
            <br>
            <br>
        </div>
        <div class="dathang">
            <?php
            if($tongtien!=0)
            {
                echo "
                <form method='post' action='Hoadon.php'>
                <table style='border: 2px solid gray;' >
                    <tr>
                        <td>Tên người nhận:</td>
                        <td><input type='text' name='tennguoinhan' ></td>
                    </tr>
                    <tr>
                        <td>Số điện thoai:</td>
                        <td><input type='text' name='sdt'></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td><input type='text' name='diachi'></td>
                    </tr>
                    <tr>
                        <td>Ghi chú:</td>
                        <td><textarea name='ghichu'  cols='40' rows='8'></textarea>
                        <input type='text' name='tongtien' value='".$tongtien."' hidden='true' ></td>
                    </tr>
                    <tr>
                        <td colspan='2'><input type='submit' name='dathang' value='Đặt hàng' class='muahang'></td>
                    </tr>
                </table>
                </form>
                "; 
            }else
            {
                echo"
                <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
                <p style='font-size:25px;color:red; text-align:center;' >Bạn chưa lựa chọn sản phẩm nào , vui lòng quay lại trang chủ để lựa chọn sản phẩm !!!</p>
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
            ?>
        </div>
    </div>

</body>
</html>