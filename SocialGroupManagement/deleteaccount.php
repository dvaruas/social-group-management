<?php
	session_start();
	include('include/db.php');
	if(isset($_POST['button6']) && ($_POST['button6']=='yes')){
		$s1="select * from tbl_updates where userid='".$_SESSION['id']."'";
		$r1=mysql_query($s1);
		while($rw1=mysql_fetch_array($r1)){
			if($rw1['type']=='photo'){
				$file="users/".$_SESSION['id']."/statusimages/".$rw1['id'].".jpg";
				unlink($file);
			}
		}
		$s2="select * from tbl_gallery where userid='".$_SESSION['id']."'";
		$r2=mysql_query($s2);
		while($rw2=mysql_fetch_array($r2)){
				$file1="users/".$_SESSION['id']."/gallery/".$rw2['imagename'];
				unlink($file1);
		}
		$filenm="users/".$_SESSION['id']."/profilepics/thumbnail_pic.jpg";
		if(file_exists ( $filenm )){
			unlink($filenm);
		}
		$filenm1="users/".$_SESSION['id']."/profilepics/resized_pic.jpg";
		if(file_exists ( $filenm1 )){
			unlink($filenm1);
		}
		$sql="delete from tbl_user where id='".$_SESSION['id']."'";
		mysql_query($sql);
		$fullpath1="users/".$_SESSION['id']."/profilepics/";
		$fullpath2="users/".$_SESSION['id']."/gallery/";
		$fullpath3="users/".$_SESSION['id']."/statusimages/";
		$fullpath4="users/".$_SESSION['id']."/";
		rmdir($fullpath1);
		rmdir($fullpath2);
		rmdir($fullpath3);
		rmdir($fullpath4);
		session_destroy();
		header('location:index.php');
	}
?>