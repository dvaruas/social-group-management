<?php
	include('include/db.php');
	$gid=$_GET['gid'];
	$sql="delete from tbl_group where id='$gid'";
	mysql_query($sql);
	$imagepath="groups/".$gid."/profilepics/".$gid.".jpg";
	unlink($imagepath);
	header('location:groups.php');
?>