<?php
	session_start();
	include('include/db.php');
	$id=$_GET['id'];
	$sql="delete from tbl_grouppostcomments where id='".$id."'";
	mysql_query($sql);
	if(isset($_GET['s']) AND ($_GET['s'])){
		header('location:homes.php');
	}
	else{
		header('location:group.php?a=0&gid='.$_SESSION['groupid']);
	}
?>
