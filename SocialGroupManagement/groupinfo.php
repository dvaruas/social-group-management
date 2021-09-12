<?php
	session_start();
	include('include/db.php');
	$gid=$_SESSION['groupid'];
	$sql1="select * from tbl_group where id='$gid'";
	$rs1=mysql_query($sql1);
	$row=mysql_fetch_array($rs1);
	if(isset($_POST['submit']) AND($_POST['submit']=='done') ){
		$description=$_POST['description'];
		$tags=$_POST['tags'];
		$sql="update tbl_group set description='$description',tags='$tags' where id='$gid'";
		mysql_query($sql);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
.amigo
{	font-family:Geneva;
	font-size:14px;
	margin:0px;
	padding:5px;
}
</style>
</head>
<body>
	<form name="frmabtgrp" action="" method="post">
		<p class="amigo">About group:</p>
		<textarea name="description" rows="3" cols="25"><?php echo $row['description']; ?></textarea>
		<p class="amigo">Tags:</p>
		<input type="text" name="tags" value="<?php echo $row['tags']; ?>" style="width:220px" />
		<input type="submit" name="submit" value="done" style="position:relative; left:80px; top:3px;" onclick="javascript:parent.closeIt();" />
	</form>
</body>
</html>
