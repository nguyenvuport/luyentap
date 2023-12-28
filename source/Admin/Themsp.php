<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Admin LapTop Store  </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="Themsp.css">
</head>
<body>
     <?php
      $connect = mysqli_connect('localhost','root','','qllaptop');

      if(isset($_POST['sbm'])){
        
        $tensp = $_POST['tensp'];
        $ttsp = $_POST['ttsp'];
        $gia = $_POST['gia'];
        $soluong = $_POST['soluong'];
        $daban = $_POST['daban'];

        $hinhanh = $_FILES['hinhanh']['name'];
        $image_tmp = $_FILES['hinhanh']['tmp_name'];

        $hangsx = $_POST['hangsx'];

        $sql = "INSERT INTO sanpham ( tensp, ttsp, gia, soluong, daban,hinhanh,hangsx)
                VALUES ( '$tensp', '$ttsp','$gia', $soluong, $daban, '$hinhanh',' $hangsx')";
        $query = mysqli_query($connect, $sql);
        move_uploaded_file($image_tmp, 'image/'.$hinhanh);
        header('location: Addpr.php');
   }
     ?>
     <div class="container">
    <div class="card">
    <div class="card-header">
           <h2> Thêm sản phẩm</h2>
    </div>
    <div class="card-body">
           <form method="POST" enctype="multipart/form-data">

               <div class="form-group">
                   <label for="">Tên sản phẩm</label>
                   <input type="text" name="tensp" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Thông tin sản phẩm</label>
                   <input type="text" name="ttsp" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Giá sản phẩm</label>
                   <input type="text" name="gia" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Số lượng sản phẩm</label>
                   <input type="text" name="soluong" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Số lượng sản phẩm đã bán </label>
                   <input type="text" name="daban" class="form-control" required >
               </div>

               <div class="form-group">
                   <label for="">Ảnh sản phẩm</label>
                   <input type="file" name="hinhanh" class="form-file">
               </div>

               <div class="form-group">
                   <label for="">Hãng sản xuất</label>
                   <input type="int" name="hangsx" class="form-control" required>
               </div>
               
               <button name="sbm" class="btn-them" type="submit"> Thêm </button>
           </form>
    </div>
    
    </div>
</div>

</body>
</html>