<?php
	include('include/db.php');
	$cmnt_id=$_GET['cmnt_id'];
	$id=$_GET['id'];
	$source=$_GET['source'];
	if($source=='gallery'){
		$sql="delete from tbl_gallerycomments where id='".$cmnt_id."'";
	}
	else if($source=='status'){
		$sql="delete from tbl_comments where id='".$cmnt_id."'";
	}
	mysql_query($sql);
	header('location:test.php?id='.$id.'&source='.$source);
?>