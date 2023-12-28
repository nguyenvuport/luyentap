<?php
   session_start();
   error_reporting(0);

    $conn = mysqli_connect("localhost","root","","qllaptop");
            mysqli_query($conn,"SET NAMES 'utf8'");
    $sql="select * from sanpham";
    $kq=mysqli_query($conn,$sql);

$output='';
if (isset($_POST["export_excel"])) {
    if (mysqli_num_rows($kq)) {
        $output.='<table class="table" border="1">
            <tr>
                <td>Mã sản phẩm </td>
                <td>Tên sản phẩm</td>
                <td>Thông tin sản phẩm</td>
                <td>Giá sản phẩm</td>
                <td>Số lượng sản phẩm</td>
                <td>Số lượng sản phẩm đã bán </td>
                <td>Ảnh sản phẩm</td>
                <td>Hãng sản xuất</td>

            </tr>';
        while($row = mysqli_fetch_row($kq))
        {
            $output.='
            <tr>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[6].'</td>
                <td>'.$row[7].'</td>
            </tr>
            ';
        }
        $output.='</table>';
        header("Content-Type:application/xls");
        header("Content-Disposition: attachment; filename=download.xls");
        echo $output;
    }

}
?>