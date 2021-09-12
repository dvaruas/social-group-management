<?php
	session_start();
	include('include/db.php');
	$groupid=$_GET['gid'];
	$userid=$_SESSION['id'];
	$dateofjoin=date('Y-m-d');
	$status=1;
	$sql="insert into tbl_grouplist(groupid,userid,dateofjoin,status) values('$groupid','$userid','$dateofjoin','$status')";
	mysql_query($sql);
	$sql1="select * from tbl_group where id='$groupid'";
	$rs1=mysql_query($sql1);
	$row=mysql_fetch_array($rs1);
	$noofmembers=$row['noofmembers'];
	$noofmembers+=1;
	$sql2="update tbl_group set noofmembers='$noofmembers' where id='$groupid'";
	mysql_query($sql2);
	header('location:group.php?a=0&gid='.$_SESSION['groupid'].'');
?>