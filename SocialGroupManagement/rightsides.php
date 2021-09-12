<?php
	//FOR MESSAGE
	
	include('include/db.php');
	include_once('include/function.php');
	if(isset($_POST['submit']) AND ($_POST['submit']=='Post')){
		$userid=$_SESSION['id'];
		$date=date('Y-m-d');
		$time_offset ="165"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$time = date("H:i:s",time() + $time_a);
		$type="message";
		$description=$_POST['shareamessage'];
		$status=1;
		$sql="insert into tbl_updates(userid,date,time,type,description,status) values('$userid','$date','$time','$type','$description','$status')";
		mysql_query($sql);
		header('refresh:1');
	}
?>
<?php
	//FOR PHOTO
	if(isset($_POST['submit']) AND ($_POST['submit']=='Share')){
		$userid=$_SESSION['id'];
		$time_offset ="165"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$time = date("H:i:s",time() + $time_a);
		$date=date('Y-m-d');
		$type="photo";
		$description=$_POST['descri'];
		$status=1;
		$sql="insert into tbl_updates(userid,date,time,type,description,status) values('$userid','$date','$time','$type','$description','$status')";
		mysql_query($sql);
		
		//UPLOAD IMAGE CODE STARTS
		
		$query="select MAX(Id) as max from tbl_updates";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$id=$row['max'];
		$uploaddir = 'users/'.$userid.'/statusimages/';
		$_FILES['uploadedfile']['name']=$id.".jpg";
		$uploadfile = $uploaddir . basename($_FILES['uploadedfile']['name']);
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadfile);
		header('refresh:1');
		//UPLOAD IMAGE CODE ENDS
		
	}
?>
<?php
	//FOR VIDEO
	/*if(isset($_POST['submit']) AND ($_POST['submit']=='Upload')){
		$userid=$_SESSION['id'];
		$date=date('Y-m-d');
		//$currenttime=date('H:i:s');
		list($h,$m,$s)=explode(':',date('H:i:s'));
		$h1=$h+4;
		$time=$h.':'.$m.':'.$s;
		$type="video";
		$description="";
		$status=1;
		$sql="insert into tbl_updates(userid,date,time,type,description,status) values('$userid','$date','$time','$type','$description','$status')";
		mysql_query($sql);
		
		$sfile=$_FILES['uploadedfile']['name'];
		$sourcefile=f_extension($sfile);
		
		//UPLOAD IMAGE CODE STARTS
		
		$query="select MAX(Id) as max from tbl_updates";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$id=$row['max'];
		$uploaddir1 = 'statusvideos/';
		$_FILES['uploadedfile']['name']=$id.$sourcefile;
		$uploadfile = $uploaddir1 . basename($_FILES['uploadedfile']['name']);
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadfile);
		
		//UPLOAD IMAGE CODE ENDS
		
	}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" href="home_style.css" type="text/css" media="screen"/>




<body>
<center>
	<div id="wrapper">
    <ul id="nav">
       <li><a id="st" href="rightsides.php">Message</a></li>
        <li><a id="pic" href="rightsidep.php">photo</a></li>
        
    </ul>
    <div id="content">
	<form name="formmsg" action="" method="post">
       <textarea name="shareamessage" cols="24" rows="3" style="overflow: -moz-scrollbars-vertical; overflow-x: hidden; overflow-y: auto"></textarea>
	   <input type="submit" name="submit" value="Post" />
	</form>
    </div>
</div>
</center>
</body>
</html>
