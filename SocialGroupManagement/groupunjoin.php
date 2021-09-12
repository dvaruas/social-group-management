<?php 
	session_start();
	include('include/db.php');
	$gid=$_GET['gid'];
	$uid=$_SESSION['id'];
	$sql="delete from tbl_grouplist where groupid='$gid' and userid='$uid'";
	mysql_query($sql);
	$sql1="select * from tbl_group where id='$gid'";
	$rs1=mysql_query($sql1);
	$row=mysql_fetch_array($rs1);
	$noofmembers=$row['noofmembers'];
	$noofmembers=$noofmembers-1;
	$sql2="update tbl_group set noofmembers='$noofmembers' where id='$gid'";
	mysql_query($sql2);
	header('location:groups.php');
?>