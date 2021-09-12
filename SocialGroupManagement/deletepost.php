<?php
	session_start();
	include('include/db.php');
	$postid=$_GET['postid'];
	$query="select * from tbl_updates where id='".$postid."'";
	$rs=mysql_query($query);
	$row=mysql_fetch_array($rs);
	if($row['type']=="photo"){
		$uploaddir = 'users/'.$_SESSION['id'].'/statusimages/';
		$_FILES['uploadedfile']['name']=$postid.".jpg";
		$uploadfile = $uploaddir . basename($_FILES['uploadedfile']['name']);
		unlink($uploadfile);
	}
	$sql="delete from tbl_updates where id='".$postid."'";
	mysql_query($sql);
	if($_GET['a']==1){
		header('location:homes.php');
	}
	else{
		header('location:nprofile.php');
	}
?>