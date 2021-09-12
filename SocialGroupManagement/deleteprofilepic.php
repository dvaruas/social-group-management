<?php
	session_start();
	$filenm="users/".$_SESSION['id']."/profilepics/thumbnail_pic.jpg";
	if(file_exists ( $filenm )){
		unlink($filenm);
	}
	$filenm1="users/".$_SESSION['id']."/profilepics/resized_pic.jpg";
	if(file_exists ( $filenm1 )){
		unlink($filenm1);
	}
	//header('location:http://' . $_SERVER['QUERY_STRING'] );
?>