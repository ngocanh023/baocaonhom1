<!doctype html>
<?php
session_start()
?>
<html>
<head>
	<link rel="stylesheet" style="text/css" href="csstt.css">
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<div id="tong">
		<div id="header">
			<img src="images/header1.jpg" style="float: left"><a href="liên hệ.html"><img src="images/header3.jpg" style="float: right"><img src="images/haeder4.jpg" style="float: right">
		</div>
	  <div id="center">
			<div class="menu">
			<img src="images/menu1.jpg" width="87" height="42" alt=""/ style="margin-left: 80px"><img src="images/menu2.jpg" width="82" height="42" alt=""/><img src="images/menu3.jpg" width="81" height="42" alt=""/><img src="images/menu4.jpg" width="67" height="42" alt=""/><img src="images/menu5.jpg" width="67" height="42" alt=""/><img src="images/menu6.jpg" width="60" height="42" alt=""/></a>
			</div>
			<img src="images/Untitled-1_20.jpg" width="1104px;">
		  <div class="left">
		  	<img src="images/Untitled-1_23.jpg"><img src="images/Untitled-1_23.jpg">
		  </div>
		  <div class="right">
<?php
$ID=$_GET['masp'];
?>
<?php 
	include('Connect.php');
?>
	
    <form method="post" enctype="multipart/form-data">
    <table id="add-prd" border="1" cellpadding="0" cellspacing="0" bgcolor="#FAB8EE">
   
    	<tr><td>Mã sản phẩm</td>
        <td>Tên sản phẩm</td>
        <td>Đơn giá</td>
        <td>Ảnh sản phẩm</td>
        <td>Số lượng</td></tr>
<?php
$sql="select * from sanpham where Code='$ID'";
$thucthi=mysqli_query($con,$sql);
$row=mysqli_fetch_array($thucthi);
$masp=$row[0];
$tensp=$row[1];
$dongia=$row[2];
$anh=$row[4];
?>       
        <tr>
		<td><?php echo $row[0];?></td>
        <td><?php echo $row[1];?></td>
        <td><?php echo $row[2];?></td>
        <td><img src="anh/<?php echo $row['image'];?>" width="100px" height="100px"/></td>
        <td><input type="textbox" name="txtsl" value='
        <?php
			if(isset($_POST['ok']))
			{ echo $_POST['txtsl']; }
			else { echo "1"; }
		
	?> '/> <br>
			<?php
	echo "có tối đa".$row['quantity']."sản phẩm"; 
	?><br /><input type="submit" name="ok" value="Cập nhật"/></td></tr>
    <tr><td align="center" colspan="5">
    <input type="submit" name="mua" value="Mua hàng" /></td></tr>
   </table></form>
   <?php
   			if(isset($_POST['ok']))
			{ echo "Tổng tiền phải trả là:".$tong=$row['price']*$_POST['txtsl'];    }
			else 
			{ echo "Tổng tiền phải trả là:".$tong=$row['price']*1; }
			     
	?>	
    
    <?php  
		if(isset($_POST['mua']))
		{
			$sl=$_POST['txtsl'];
			$slcon=$row['quantity']-$_POST['txtsl'];
			$sql2="update sanpham set quantity=$slcon where Code='$id'";
			$thucthi2=mysqli_query($con,$sql2);
			$sql3="insert into hoadon(Masp,tensp,dongia,anh,soluong,thanhtien) values('$masp','$dongia','$anh','$slcon','$tong')";
			$thucthi3=mysqli_query($con,$sql2);
			if($thucthi3) header('location:thanhtoans.php');	
		}
</body>
</html>
