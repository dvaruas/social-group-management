<?php
	session_start();
	include('include/db.php');
	$requestorid=$_SESSION['id'];
	$acceptorid=$_GET['fid'];
	$status=1;
	$sql="insert into tbl_friendlist(requesterid,acceptorid,status) values('$requestorid','$acceptorid','$status')";
	mysql_query($sql);
	header('location:oprofile.php?id='.$acceptorid);
?>