<?php
	//session_start();
//	include('include/db.php');
//	if(isset($_POST['submit']) AND ($_POST['submit']=='Share')){
//		$userid=$_SESSION['id'];
//		$date=date('Y-m-d');
//		//$currenttime=date('H:i:s');
//		list($h,$m,$s)=explode(':',date('H:i:s'));
//		$h1=$h+4;
//		$time=$h.':'.$m.':'.$s;
//		$type="photo";
//		$description="";
//		$status=1;
//		$sql="insert into tbl_updates(userid,date,time,type,description,status) values('$userid','$date','$time','$type','$description','$status')";
//		mysql_query($sql);
//		
//		//UPLOAD IMAGE CODE STARTS
//		
//		$query="select MAX(Id) as max from tbl_updates";
//		$result=mysql_query($query);
//		$row=mysql_fetch_array($result);
//		$id=$row['max'];
//		$uploaddir = 'statusimages/';
//		$_FILES['uploadedfile']['name']=$id.".jpg";
//		$uploadfile = $uploaddir . basename($_FILES['uploadedfile']['name']);
//		move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadfile);
//		
//		//UPLOAD IMAGE CODE ENDS
//		
//	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="home_style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="home.js"></script>
</head>

<body>
<table width="100%" border="0" cellpadding="0">
  <tr>
    <td colspan="2">
		<?php include('include/upperhead.php');?>
	</td>
  </tr>
  <tr>
  <td rowspan="2" width="70%">
	the updates
	</td>
    <td>
	<br /><br />
	<center>
	<div id="wrapper">
    <ul id="nav">
       <li><a id="st" href="homes.php">Message</a></li>
        <li><a id="pic" href="homep.php">photo</a></li>
        <li><a id="vd" href="homev.php">video</a></li>
    </ul>
    <div id="content">
	<form name="formimg" method="post" enctype="multipart/form-data">
      <input type="file"  name="uploadedfile" id="file" /><br />
	  <input type="submit" name="submit" value="Share" /><br />
	  <input type="button" value="open gallery" />
	</form>
    </div>
</div>
</center>

	</td>
	</tr>
	<tr>
	 <td>
	chat portion
	</td>
	</tr>
</table>
</body>
</html>
