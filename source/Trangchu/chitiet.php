<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> LAPTOP STORE </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="chitiet.css">
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
                                 header('Location: Giohang.php');
                            }
                        }else
                        {
                            $lb='Trong kho không đủ hàng';
                        }
                    }
                if($row['soluong']!=0)
                {
                    echo "
                     <div class='content'>
    					<div class='chuyen'>
    		 				<p style='font-size:20px'><i class='fa fa-home' ></i> <span style='color:gray;'>TRANG CHỦ </span> / CHI TIẾT SẢN PHẨM </p>
    					</div>

    				<div class='sanpham'>
    					<div id='hinhanh'>
    						<img src='/WebLapTop/image/".$row['hinhanh']."'>
    					</div>
    					<div id='ttsanpham'>
    			 			<div class='ttsp'>
                            	<div id='tensp'>
                                	<P> ".$row['tensp']." </P>
                                	<hr>
                                </div>
                            	<div id='gia'>
                           		<p> ".number_format($row['gia'])." VNĐ</p>
                            </div>
                            	<div id='mota'>
                                <P> ".$row['ttsp']."</P>
                            	</div>
                            	<form method='post'>
                        <div class='mua'>
                        <input type='text' name='masp' value='".$row['masp']."' hidden='true'>
                          <input style='text-align: center;' type='number' name='sl' id='txtsl' value='".$sl."'>
                           <button type='submit' name='buy' href='Giohang.php' > Thêm vào giỏ hàng </button>
                        </div>
                        </form>
    				</div>
    			</div>
    		</div>
                    ";
                }elseif($row['soluong']==0)
                {
                    echo "
               <div class='content'>
    					<div class='chuyen'>
    		 				<p style='font-size:20px'><i class='fa fa-home' ></i> <span style='color:gray;'>TRANG CHỦ </span> / CHI TIẾT SẢN PHẨM </p>
    					</div>

    				<div class='sanpham'>
    					<div id='hinhanh'>
    						<img src='/WebLapTop/image/".$row['hinhanh']."'>
    					</div>
    					<div id='ttsanpham'>
    			 			<div class='ttsp'>
                            	<div id='tensp'>
                                	<P> ".$row['tensp']." </P>
                                	<hr>
                                </div>
                            	<div id='gia'>
                           		<p> ".number_format($row['gia'])." VNĐ</p>
                            </div>
                            	<div id='mota'>
                                <P> ".$row['ttsp']."</P>
                            	</div>
                            	<form method='post'>
                        <div class='mua'>
                           <p style='color:red;'>Hết hàng</>
                        </div>
                        </form>
    				</div>
    			</div>
    		</div>
                    ";
                }
            }
            
        ?>
    </div>
</body>
</html>