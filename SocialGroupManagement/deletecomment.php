<?php
	include('include/db.php');
	$id=$_GET['id'];
	$sql="delete from tbl_comments where id='".$id."'";
	mysql_query($sql);
	header('location:homes.php');
?>
