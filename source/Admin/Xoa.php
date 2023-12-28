<?php
     $connect = mysqli_connect('localhost','root','','qllaptop');
     
     $id = $_GET['id'];
     $sql = "DELETE FROM sanpham where masp = '$id'";
     $query = mysqli_query($connect,$sql);
     header('location: Addpr.php');
?>