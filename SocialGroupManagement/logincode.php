<?php
	session_start();
	include('include/db.php');
	$_SESSION['user_login_flag']=0;
	$userid=$_POST['userid'];
	$password=$_POST['password'];
	$sql="select * from tbl_user where emailid='$userid' and password='$password' and status=1";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)<>0){
		if(isset($_POST['remember']) && ($_POST['remember']['value']==1)){
			setcookie("cookname",$userid,time()+3600);
			setcookie("cookpass",$password,time()+3600);
		}
		$row=mysql_fetch_array($rs);
		$_SESSION['id']=$row['id'];
		$_SESSION['gender']=$row['gender'];
		$sql1="update tbl_user set loginstatus='1' where id='".$_SESSION['id']."'";
		mysql_query($sql1);
		$_SESSION['user_login_flag']=1;
		header('location:homes.php');
	}
	else
		header('location:index.php?a=1');
?>