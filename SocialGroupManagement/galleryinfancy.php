<?php
	session_start();
	$imgid=$_GET['img'];
?>
<div id="imgdiv">
	<img src="users/<?php echo $_SESSION['id']; ?>/gallery/<?php echo $imgid; ?>.jpg" />
</div>