<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$id=$_GET['id'];
	if($id==1){
		$sql="select * from tbl_friendlist where requesterid='".$_SESSION['id']."'";
	}
	else if($id==2){
		$sql="select * from tbl_friendlist where acceptorid='".$_SESSION['id']."'";
	}
	$rs=mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My Connections</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="home.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.ron').hover(function(){
			$(this).find('.muggle').slideToggle('slow');
		});
	});
</script>
<style>
*
{	margin:0px;
	padding:0px;
}
.harry
{	height:50px;
	width:50px;
}
.ron
{	position:relative;
}
.ron:hover
{ -moz-box-shadow:    0px 0px 10px 2px #999999;
  -webkit-box-shadow: 0px 0px 10px 2px #999999;
  box-shadow:         0px 0px 10px 2px #999999;
}
.herm
{	font-family:Helvetica;
	font-size:12px;
	padding:0px;
	margin:0px;
}
.muggle
{	position:absolute;
	z-index:100;
	top:10%;
	font-size:10px;
	font-family:Verdana;
	display:none;
	background:#FFFFFF;
	width:100px;
}
.buttons
{	height:20px;
	width:200px;
	opacity:0.7;
}
.buttons:hover
{	opacity:1.0;
}
</style>
</head>

<body background="images/body_background.jpg">
<table width="100%" border="0" style="padding:10px">
	<tr>
		<td colspan="2">
			<?php include('include/upperhead.php');?>
			<br />
		</td>
	</tr>
	<tr>
		<td>
			<a href="connections.php?id=1"><img src="images/cwith.png" class="buttons" /></a>
			<a href="connections.php?id=2"><img src="images/cto.png" class="buttons" /></a>
		</td>
		<td rowspan="3">
			<?php include('rightsides.php'); ?><br />
			<?php include('onlinefriends.php'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="20px">
			<?php 
							$temp=0;
							while($row=mysql_fetch_array($rs)){ 
							if($temp==0){ ?>
							<tr>
							<?php }   ?>
				
					<!-- starting an element -->
					<td class="mox" style="padding:20px">
						<?php 
								if($id==1){
									$query="select * from tbl_user where id='".$row['acceptorid']."'";
								}
								else if($id==2){
									$query="select * from tbl_user where id='".$row['requesterid']."'";
								}
								$result=mysql_query($query);
								$data=mysql_fetch_array($result);
						?>
						<table class="ron">
							<tr>
								<td rowspan="3">
 									
									<?php
										$filename="users/".$data['id']."/profilepics/thumbnail_pic.jpg";
										$filename1="users/".$data['id']."/profilepics/resized_pic.jpg";
										if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data['gender']=='male')){
									?>
									<img src="images/profile_pic.jpg" class="harry"  />	
									<?php
										}
										else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data['gender']=='female')){
									?>
									<img src="images/profile_pic_f.jpg" class="harry"  />	
									<?php
										}
										else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
									?>
									
									<img src="users/<?php echo $data['id']; ?>/profilepics/resized_pic.jpg" class="harry"  />
									
									
									<?php
										}
										else{
									?>
									
									<img src="users/<?php echo $data['id']; ?>/profilepics/thumbnail_pic.jpg" class="harry"  />
									<?php
										}
									?>
								</td>
								<td>
									<p class="herm"><?php echo $data['name']; ?></p>
								</td>
								<td rowspan="3">
									<div class="muggle">
										<a href="messages.php" style="text-decoration:none">Send a message</a><br />
										<?php
											if($id==1){
										?>
										<a href="deletefriend.php?ownid=<?php echo $_SESSION['id']; ?>&frndid=<?php echo $data['id']; ?>&id=1" style="text-decoration:none">Disconnect</a><br />
										<?php
											}
											else if($id==2){
										?>
										<a href="deletefriend.php?ownid=<?php echo $_SESSION['id']; ?>&frndid=<?php echo $data['id']; ?>&id=2" style="text-decoration:none">Disconnect</a><br />
										<?php
											}
										?>
										<a href="oprofile.php?id=<?php echo $data['id']; ?>" style="text-decoration:none">View profile</a><br />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<p class="herm"><?php  ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<p class="herm"><?php echo $data['location']; ?></p>
									
								</td>
							</tr>
									
								
						</table>
						
					</td>
					<?php $temp++;
					if($temp==4){
						?>
						</tr>
						<?php $temp=0;
						} } ?>
					<!-- ending one element -->
				
			</table>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
		</td>
		<td>
			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php include('include/footer.php'); ?>
		</td>
	</tr>
	<!--<tr>
		<td>
			<p style="font-family: Andalus; font-size:22px">People you may know: </p>
		</td>
	</tr>-->
</table>
</body>
</html>
