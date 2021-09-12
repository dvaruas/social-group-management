<?php 
	$gid=$_GET['gid'];
	if(isset($_POST['submit']) AND ($_POST['submit']=='Upload')){
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
	}
?>
