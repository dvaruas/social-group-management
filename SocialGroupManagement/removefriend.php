<?php
	session_start();
	include('include/db.php');
	$requestorid=$_SESSION['id'];
	$acceptorid=$_GET['fid'];
	$status=1;
	$sql="delete from tbl_friendlist where requesterid='$requestorid' and acceptorid='$acceptorid'";
	mysql_query($sql);
	header('location:oprofile.php?id='.$acceptorid);
?>