<?php 
	$gid=$_GET['gid'];
	/*if(isset($_POST['submit']) AND ($_POST['submit']=='Upload')){
		echo "hello";
		exit();
		$uploaddir = 'groups/'.$gid.'/profilepics/';
		$_FILES['uploadedfile']['name']=$gid.".jpg";
		$uploadfile = $uploaddir . basename($_FILES['uploadedfile']['name']);
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadfile);
		header('location:group.php?a=0&gid='.$gid);
	}
	if(isset($_POST['submit1']) AND ($_POST['submit1']=='Delete')){
		$file="groups/".$gid."/profilepics/".$gid.".jpg";
		if(file_exists ( $file )){
			unlink($file);
		}
		header('location:group.php?a=0&gid='.$gid);
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="frmgrppic" action="uploadgroupimage.php?gid=<?php echo $gid; ?>" method="post" enctype="multipart/form-data">
	<input type="file" id="file" name="uploadedfile" />
	<input type="submit" name="submit" value="Upload" />
	<input type="submit" name="submit1" value="Delete" />
</form>
</body>
</html>
