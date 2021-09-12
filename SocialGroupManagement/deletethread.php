<?php
	session_start();
	include('include/db.php');
	$threadid=$_GET['tid'];
	$sql1="select * from tbl_thread where id='$threadid'";
	$rs1=mysql_query($sql1);
	$row1=mysql_fetch_array($rs1);
	if($_SESSION['id']==$row1['initiatorid']){
		$sql="update tbl_thread set initiatorstatus='0' where id='$threadid'";
		if($row1['receiverstatus']==0)
			$sql="delete from tbl_thread where id='$threadid'";
	}
	else if($_SESSION['id']==$row1['receiverid']){
		$sql="update tbl_thread set receiverstatus='0' where id='$threadid'";
		if($row1['initiatorstatus']==0)
			$sql="delete from tbl_thread where id='$threadid'";
	}
	mysql_query($sql);
	header('location:messages.php');
?>