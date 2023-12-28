<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapTop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Hoadon.css">
</head>
<body>
    <?php
        $conn =new mysqli('localhost','root','','qllaptop');
        $sql = "SELECT * FROM sanpham";
        $result = $conn->query($sql);
        $uid='';
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
                <li><a><i class="fa-solid fa-gift"></i>  Khuyến mãi</a></li>
        </ul>
  </nav>
 </div>


     <div class="content">
    <?php
                if(isset($_POST['dathang']))
                {
                    $tennguoinhan=$_POST['tennguoinhan'];
                    $sodienthoai=$_POST['sdt'];
                    $diachi=$_POST['diachi'];
                    $note=$_POST['ghichu'];
                    $tong=$_POST['tongtien'];
                    $oder="INSERT INTO oder(tennguoinhan,sdt,diachi,note,user_id,tongbill,loaibill) VALUES('$tennguoinhan','$sodienthoai','$diachi','$note','$uid','$tong','1')";
                    $kqoder=$conn->query($oder);
                    if($kqoder)
                    {
                        $ttoder="SELECT * FROM oder WHERE loaibill='1'";
                        $kqttoder=$conn->query($ttoder);
                        while($row=$kqttoder->fetch_assoc())
                        {
                            if($row['loaibill'])
                            {
                                $oderid=$row['id'];
                                $sanphamoder="SELECT * FROM spmua WHERE manguoidung='$uid'AND order_id='0'";
                                $kqsanphamoder=$conn->query($sanphamoder);
                                echo"
                                <div id='hoadon'>
                                <table >
                                    <caption>HÓA ĐƠN</caption>
                                    <tr>
                                        <th>Tên người nhận:</th>
                                        <th>".$tennguoinhan."</th>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoai:</th>
                                        <th>".$sodienthoai."</th>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <th>".$diachi."</th>
                                    </tr>
                                    <tr>
                                        <th>Ghi chú:</th>
                                        <th>".$note."</th>
                                    </tr>
                                    <tr>
                                        <th colspan='2'>Sản phẩm đã mua:</th>
                                    </tr>
                                ";
                                while($rows = $kqsanphamoder->fetch_assoc())
                                {
                                    $sl=$rows['soluong'];
                                    $slcon=0;
                                    $slban=0;
                                    $masp=$rows['masp'];
                                    
                                    $ttsp="SELECT * FROM sanpham WHERE masp='$masp'";
                                    $kqttsp=$conn->query($ttsp);
                                    while($rowss = $kqttsp->fetch_assoc())
                                    {
                                        $soluongsp=$rowss['soluong'];
                                        $dabansp=$rowss['daban'];
                                        $slcon=$soluongsp-$sl;
                                        $slban=$dabansp+$sl;
                                        $updatesp="UPDATE sanpham SET soluong='$slcon', daban='$slban' WHERE masp='$masp' ";
                                        $kqupdatesp=$conn->query($updatesp);
                                        echo "
                                    <tr>
                                        <td colspan='2'>".$rowss['tensp']."<img src='".$rowss['hinhanh']."' ></td>
                                    </tr>
                                    ";
                                        }
                                    }
                                    $suaspmua="UPDATE spmua SET order_id='$oderid' WHERE order_id='0' ";
                                    $kqsuaspmua=$conn->query($suaspmua);
                                    if($kqsuaspmua)
                                    {

                                        $sualoaibill="UPDATE oder SET loaibill='0'";
                                        $kqsualoaibill=$conn->query($sualoaibill);
                                }
                                            echo"
                                                <tr>
                                                    <th>Tổng tiền :</th>
                                                    <th>".$tong."</th>
                                                </tr>
                                            </table>
                                            </div>
                                            ";
                            }
                            
                            
                        }
                    }
                }
            ?>
            <div id="thanks">
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>Cảm ơn quý khách đã mua sản phẩm ở shop !!!</p>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
     </div>
</body>
</html>