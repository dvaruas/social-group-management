<?php
	session_start();
	include('include/db.php');
	$id=$_GET['id'];
	$source=$_GET['source'];
	$flag=0;
	if(isset($_GET['ouid'])){
		$ouid=$_GET['ouid'];
		$flag=1;
		
	}
	if(isset($_POST['submit']) && ($_POST['submit']=="post")){
		$comment=$_POST['cmnt'];
		$uid=$_SESSION['id'];
		$status=1;
		if($source=='gallery'){
			$imageid=$id;
			$query="insert into tbl_gallerycomments(imageid,userid,comment,status) values('$imageid','$uid','$comment','$status')";
		}
		else if($source=='status'){
			$updateid=$id;
			$time_offset ="165"; // Change this to your time zone
			$time_a = ($time_offset * 120);
			$time = date("H:i:s ",time() + $time_a);
			$date=date('Y-m-d');
			$query="insert into tbl_comments(updateid,userid,commenttime,commentdate,comment,status) values('$updateid','$uid','$time','$date','$comment','$status')";
		}
		mysql_query($query);
	}
	if($source=='gallery'){
		$sql="select * from tbl_gallerycomments where imageid='".$id."'";
	}
	else if($source=='status'){
		$sql="select * from tbl_comments where updateid='".$id."'";
	}

	$rs=mysql_query($sql);
	
?>
<style>
	*
	{	margin:0px;
		padding:0px;
	}
	.asd
	{	font-family:Andalus;
		font-size:9px;
		opacity:0.5;
		text-decoration:none;
		color:#000000;
	}
	.asd:hover
	{	opacity:1.0;
	}
</style>
<div style="width:500px; border:#999999 solid; padding:8px;">
<ol style="list-style:none; padding:0px; margin:0px;">
<li>
<?php 
	while($row=mysql_fetch_array($rs)){
		$sql1="select name from tbl_user where id='".$row['userid']."'";
		$rs1=mysql_query($sql1);
		$row1=mysql_fetch_array($rs1);
		$username=$row1['name'];
?>
	<table class="ad">
		<tr>
			<td>
				<?php
					$filename="users/".$row['userid']."/profilepics/thumbnail_pic.jpg";
					$filename1="users/".$row['userid']."/profilepics/resized_pic.jpg";
					if(!file_exists ( $filename ) && !file_exists ( $filename1 )){
				?>
				<img src="images/profile_pic.jpg" width="20" height="20"  />	
				<?php
					}
					else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
				?>
				<img src="users/<?php echo $row['userid']; ?>/profilepics/resized_pic.jpg" width="20" height="20"  />
				<?php
					}
					else{
				?>
				<img src="users/<?php echo $row['userid']; ?>/profilepics/thumbnail_pic.jpg" width="20" height="20"  />
				<?php
					}
				?>
			</td>
			<td width="450">
				<p style="font-family: Georgia; font-size:10px; padding-left:5px"><?php echo $username;?> : </p>
			</td>
			<td>
				<?php
					if($flag==0 OR ($row['userid']!=$ouid)){
				?>
				<a class="asd" href="gal_deletecomment.php?cmnt_id=<?php echo $row['id']; ?>&id=<?php echo $id; ?>&source=<?php echo $source; ?>">X</a>
				<?php
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<p style="font-family: Verdana; font-size:10px; padding-left:20px; width:400px; word-wrap:break-word"><?php echo $row['comment']; ?></p>
			</td>
			<td>
			</td>
		</tr>
	</table>
	<hr />
<?php
	}
?>
</li>

</ol>
	<div style="padding:10px; text-align:center">
	<form name="gallercmnt" method="post" action="">
		<textarea rows="2" cols="55" name="cmnt" style="font-family: Verdana; font-size:12px"></textarea>
		<input type="image" src="images/comment.png" name="submit" value="post" />
	</form>
	</div>
</div>