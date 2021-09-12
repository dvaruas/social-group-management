<?php
	session_start();
	include('include/db.php');
	$postid=$_GET['pid'];
	$type=$_GET['type'];
	$gid=$_GET['gid'];
	$sql="delete from tbl_grouppost where id='$postid'";
	mysql_query($sql);
	if($type=='image'){
		echo $path="groups/".$gid."/grouppics/".$postid.".jpg";
		unlink($path);
	}
	if(isset($_GET['s']) AND ($_GET['s']==1)){
		header('location:homes.php');
	}
	else{
		header('location:group.php?a=1&gid='.$gid);
	}
?>