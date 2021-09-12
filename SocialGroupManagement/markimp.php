<?php
	session_start();
	include('include/db.php');
	$threadid=$_GET['tid'];
	$value=$_GET['value'];
	$sql="update tbl_thread set impstatus='$value' where id='$threadid'";
	mysql_query($sql);
	if($_GET['source']=='thread'){
		header('location:thread.php?tid='.$threadid);
	}
	else if($_GET['source']=='messages'){
		header('location:messages.php');
	}
?>