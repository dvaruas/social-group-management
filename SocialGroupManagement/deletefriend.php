<?php
	session_start();
	include('include/db.php');
	$frndid=$_GET['frndid'];
	$ownid=$_GET['ownid'];
	$id=$_GET['id'];
	if($id==1){
		$sql="delete from tbl_friendlist where requesterid='$ownid' and acceptorid=$frndid";
	}
	else if($id==2){
		$sql="delete from tbl_friendlist where requesterid='$frndid' and acceptorid='$ownid'";
	}
	mysql_query($sql);
	header('location:connections.php?id=1');
?>