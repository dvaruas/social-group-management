<?php
	session_start();
	include('include/db.php');
	$msgid=$_GET['msgid'];
	$tid=$_GET['tid'];
	$sql1="select * from tbl_messages where id='$msgid'";
	$rs1=mysql_query($sql1);
	$row1=mysql_fetch_array($rs1);
	if($_SESSION['id']==$row1['senderid']){
		$sql="update tbl_messages set senderstatus='0' where id='$msgid'";
		if($row1['receiverstatus']==0)
			$sql="delete from tbl_messages where id='$msgid'";
	}
	else if($_SESSION['id']==$row1['receiverid']){
		$sql="update tbl_messages set receiverstatus='0' where id='$msgid'";
		if($row1['senderstatus']==0)
			$sql="delete from tbl_messages where id='$msgid'";
	}
	mysql_query($sql);
	header('location:thread.php?tid='.$tid);
?>