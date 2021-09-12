<?php
	session_start();
	include('include/db.php');
	$id=$_GET['id'];
	$sql6="update tbl_chat set status='0' where and userid='$id'";
	mysql_query($sql6);
	$sql7="insert into tbl_chatrequest(userid,receiverid,status) values('".$_SESSION['id']."','$id','1')";
	mysql_query($sql7);
	header('location:chat/chat.php?id='.$id);
?>