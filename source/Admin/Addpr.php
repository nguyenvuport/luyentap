<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Admin LapTop Store </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="Addpr.css">
</head>
<body>

	   <?php
	   $connect = mysqli_connect('localhost','root','','qllaptop');
	   $sql = "SELECT * FROM sanpham";
       $query = mysqli_query($connect, $sql);
	?>
	
	<div class="container-fluid">
     <div class="card">
          <div class="card-header">
                <h2>Danh sách sản phẩm</h2>
          </div>
          <div class="card-body">
              <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th> Mã sản phẩm </th>
                        <th> Tên sản phẩm </th>
                        <th> Mô tả </th>
                        <th> Giá </th>
                        <th> Số lượng </th>
                        <th> Đã bán </th>
                        <th> Ảnh </th>
                        <th> Hãng sản xuất </th>
                        <th colspan="2"> Thao tác </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      while($row = mysqli_fetch_assoc($query)){?>
                    <tr>
                        <td><?php echo $row['masp'] ;?></td>
                        <td><?php echo $row['tensp'] ;?></td>
                        <td><?php echo $row['ttsp'] ;?></td>
                        <td><?php echo $row['gia'] ;?></td>
                        <td><?php echo $row['soluong'] ;?></td>
                        <td><?php echo $row['daban'] ;?></td>
                        <td>
                            <img style="width: 100%;" src="/WebLapTop/source/image/<?php echo $row['hinhanh'] ;?>">
                        </td>
                        <td><?php echo $row['hangsx'] ;?></td>
                        <td> 
                            <a class="action" href="Sua.php?id=<?php echo $row['masp']; ?>"> <i class="fa-solid fa-pen-to-square"></i> Sửa </a> 
                        </td>
                        <td> 

                            <a class="action" href="Xoa.php?id=<?php echo $row['masp']; ?>" onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này không?')"> <i class="fa-solid fa-trash-can"> </i> Xóa </a> 
                        </td>
                    </tr>
                   <?php } ?>
                </tbody>

              </table>
              <div class="thaotac">
              <a class="btn-primary" href="Themsp.php">Thêm mới</a>

              <form action="export_excel.php" method="POST">
              	<input type="submit" class="sm" name="export_excel" value="Xuất Excel">
              </form>
          </div>

          </div>          
     </div>
</div>

</body>
</html>