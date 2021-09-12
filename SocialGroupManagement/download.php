<?php
	session_start();
	include('include/db.php');
	$id=$_GET['download_file'];
	$source=$_GET['source'];
	$flag=0;
	if(isset($_GET['uuid'])){
		$uuid=$_GET['uuid'];
		$flag=1;
	}
	// place this code inside a php file and call it f.e. "download.php"
	if($source=='gallery' AND $flag==0){
		$path = $_SERVER['DOCUMENT_ROOT']."SocialGroupManagement/users/".$_SESSION['id']."/gallery/"; // change the path to fit your websites document structure
	}
	else if($source=='gallery' AND $flag==1){
		$path = $_SERVER['DOCUMENT_ROOT']."SocialGroupManagement/users/".$uuid."/gallery/"; // change the path to fit your websites document structure
	}
	else if($source=='status' AND $flag==0){
		$path = $_SERVER['DOCUMENT_ROOT']."SocialGroupManagement/users/".$_SESSION['id']."/statusimages/";
	}
	else if($source=='status' AND $flag==1){
		$path = $_SERVER['DOCUMENT_ROOT']."SocialGroupManagement/users/".$uuid."/statusimages/";
	}
	$fullPath = $path.$_GET['download_file'];
	
	if ($fd = fopen ($fullPath, "r")) {
		$fsize = filesize($fullPath);
		$path_parts = pathinfo($fullPath);
		$ext = strtolower($path_parts["extension"]);
		switch ($ext) {
			case "pdf":
			header("Content-type: application/pdf"); // add here more headers for diff. extensions
			header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
			break;
			default;
			header("Content-type: application/octet-stream");
			header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
		}
		header("Content-length: $fsize");
		header("Cache-control: private"); //use this to open files directly
		while(!feof($fd)) {
			$buffer = fread($fd, 2048);
			echo $buffer;
		}
	}
	fclose ($fd);
	
	// example: place this kind of link into the document where the file download is offered:
	// <a href="download.php?download_file=some_file.pdf">Download here</a>
?>
