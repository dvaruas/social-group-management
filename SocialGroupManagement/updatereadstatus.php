<?php
	session_start();
	include('include/db.php');
	$tid=$_GET['tid'];
	$sql3="update tbl_messages set readstatus=1 where threadid='$tid'";
	mysql_query($sql3);
	header('location:thread.php?tid='.$tid);
?>