<?php
	session_start();
	include('include/db.php');
	$id=$_GET['remove_file'];
	$source=$_GET['source'];
	$file_id=$_GET['file_id'];
	if($source=='gallery'){
		$path = $_SERVER['DOCUMENT_ROOT']."SocialGroupManagement/users/".$_SESSION['id']."/gallery/"; // change the path to fit your websites document structure
		$sql="delete from tbl_gallery where id='".$file_id."'";
	}
	else if($source=='status'){
		$path = $_SERVER['DOCUMENT_ROOT']."SocialGroupManagement/users/".$_SESSION['id']."/statusimages/";
		$sql="delete from tbl_updates where id='".$file_id."'";
	}
	echo $fullPath = $path.$_GET['remove_file'];
	
	unlink($fullPath);
	mysql_query($sql);
	header('location:gallery.php');
?>