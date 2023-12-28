<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Admin LapTop Store  </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="Sua.css">
</head>
<body>
<?php
  $connect = mysqli_connect('localhost','root','','qllaptop');
  $id = $_GET['id'];
   
   $sql_sanpham = "SELECT * FROM sanpham ";
   $query_sanpham = mysqli_query($connect, $sql_sanpham);

   $sql_up = "SELECT * FROM sanpham WHERE masp = $id";
   $query_up = mysqli_query($connect, $sql_up);
   $row_up = mysqli_fetch_assoc($query_up);

   if( isset($_POST['sbm']) ){

        $tensp = $_POST['tensp'];
        $ttsp = $_POST['ttsp'];
        $gia = $_POST['gia'];
        $soluong = $_POST['soluong'];
        $daban = $_POST['daban'];
        
        if($_FILES['hinhanh']['name'] ==''){
            $hinhanh = $row_up['hinhanh'];
        
           }else {
            $hinhanh = $_FILES['hinhanh']['name'];
            $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
            move_uploaded_file($hinhanh_tmp, '/WEBLAPTOP/image/'.$hinhanh);
        
           }
        $hangsx = $_POST['hangsx'];

         
       $sql = "UPDATE sanpham SET 
       tensp = '$tensp', 
       ttsp = '$ttsp', 
       gia = '$gia', 
       soluong = '$soluong', 
       daban = '$daban', 
       hinhanh = '$hinhanh', 
       hangsx = '$hangsx' 
       WHERE masp = $id";

       $query = mysqli_query($connect, $sql);
    if(mysqli_query($connect, $sql)) {
        echo "Sản phẩm đã được cập nhật thành công.";
    } else {
        echo "Có lỗi xảy ra khi cập nhật sản phẩm: " . mysqli_error($conn);
    }
        header('location: Addpr.php');
   }
?>

   <div class="container">
    <div class="card">
    <div class="card-header">
           <h2> Sửa sản phẩm</h2>
    </div>
    <div class="card-body">
           <form method="POST" enctype="multipart/form-data">

               <div class="form-group">
                   <label for="">Tên sản phẩm</label>
                   <input type="text" value="<?= $row_up['tensp'] ?>" name="tensp" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Thông tin sản phẩm</label>
                   <input type="text" value="<?= $row_up['ttsp'] ?>" name="ttsp" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Giá sản phẩm</label>
                   <input type="text" value="<?= $row_up['gia'] ?>" name="gia" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Số lượng sản phẩm</label>
                   <input type="text" value="<?= $row_up['soluong'] ?>" name="soluong" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Số lượng sản phẩm đã bán </label>
                   <input type="text" value="<?= $row_up['daban'] ?>" name="daban" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Ảnh sản phẩm</label>
                   <input type="file" value="<?= $row_up['hinhanh'] ?>" name="hinhanh" class="form-file">
               </div>

               <div class="form-group">
                   <label for="">Hãng sản xuất</label>
                   <input type="int" value="<?= $row_up['hangsx'] ?>" name="hangsx" class="form-control" required>
               </div>
               
               <button name="sbm" class="btn-them" type="submit"> Sửa </button>
           </form>
    </div>
    
    </div>
</div>

</body>
</html>