<?php
	session_start();
	include('include/db.php');
	$sql1="update tbl_user set loginstatus='0' where id='".$_SESSION['id']."'";
	mysql_query($sql1);
	$_SESSION['user_login_flag']=0;
	session_destroy();
	header('location:index.php');
?>