<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$sql1="select * from tbl_grouplist where userid='".$_SESSION['id']."'";
	$result=mysql_query($sql1);

	if(isset($_POST['submit']) AND ($_POST['submit']=='Create')){
		$name=$_POST['groupname'];
		$creationdate=date('Y-m-d');
		$ownerid=$_SESSION['id'];
		$tags='';
		$noofmembers=1;
		$description='';
		$status=1;
		$sql="insert into tbl_group(name,creationdate,ownerid,tags,noofmembers,description,status) values('$name','$creationdate','$ownerid','$tags','$noofmembers','$description','$status')";
		mysql_query($sql);
		$query="select MAX(id) as max from tbl_group";
		$rs=mysql_query($query);
		$row=mysql_fetch_array($rs);
		$groupid=$row['max'];
		mkdir("../SocialGroupManagement/groups/$groupid");
		mkdir("../SocialGroupManagement/groups/$groupid/profilepics");
		mkdir("../SocialGroupManagement/groups/$groupid/grouppics");
		$userid=$_SESSION['id'];
		$dateofjoin=date('Y-m-d');
		$status=1;
		$sql2="insert into tbl_grouplist(groupid,userid,dateofjoin,status) values('$groupid','$userid','$dateofjoin','$status')";
		mysql_query($sql2);
		header('location:group.php?a=0&gid='.$groupid);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My Groups</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="home.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<style>
p
{	margin:0px;
	padding:0px;
}
.alu
{	height:150px;
	width:150px;
	padding:10px;
}
.ande
{	position:absolute;
	z-index:100;
	top:20px;
	left:15px;
	display:none;
}	
.ploi
{	position:relative;
}
.ploi:hover .alu
{	opacity:0.2;
}
.ploi:hover .ande
{	display:block;
}
</style>
</head>

<body background="images/body_background.jpg">
<table width="100%" border="0">
	<tr>
		<td colspan="2">
			<?php include('include/upperhead.php'); ?>
			<br />
		</td>
	</tr>
	<tr>
		<td>
			<form name="formgrp" action="" method="post">
				<p style=" font-family:Andalus; font-size:20px;">Create a new group: 
				<input type="text" placeholder="Enter group name" name="groupname" />
				<input type="submit" name="submit" value="Create" /></p> 
			</form>
		</td>
		<td rowspan="3">
			<?php include('rightsides.php'); ?><br />
			<?php include('onlinefriends.php'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<table>
				<tr>
					<td>
					</td>
				</tr>
					<?php
						$temp=0;
						while($data=mysql_fetch_array($result)){
							$sql2="select * from tbl_group where id='".$data['groupid']."'";
							$rs1=mysql_query($sql2);
							$data1=mysql_fetch_array($rs1);
							if($temp==0)
							{
					?>
				<tr>
				<?php } ?>
					<td>
					
						<div class="ploi">
						<a href="group.php?a=0&gid=<?php echo $data1['id'];?>">
						<?php
							$grpname="groups/".$data1['id']."/profilepics/".$data1['id'].".jpg";
							if(!file_exists ( $grpname )){
						?>
						<img src="images/default-group-image.gif" class="alu" />
						<?php 
							}
							else{
						?>
						<img src="groups/<?php echo $data1['id']; ?>/profilepics/<?php echo $data1['id']; ?>.jpg" class="alu" />
						<?php
							}
						?>
						</a>
						<div class="ande">
							<p style="font-family:Georgia; font-size:20px"><?php echo $data1['name']; ?></p><br />
							<p style="font-family:Verdana; font-size:12px">Tags:<?php echo $data1['tags']; ?><br />
							Members:<?php echo $data1['noofmembers']; ?><br />
							<?php
								if($data1['ownerid']!=$_SESSION['id']){
							?>
							<a href="groupunjoin.php?gid=<?php echo $data1['id'];?>&uid=<?php echo $_SESSION['id'];?>" style="text-decoration:none; color:#000000">Unjoin</a></p>
							<?php
								}
							?>
						</div>
						</div>
					</td>
					<?php $temp++;
					if($temp==4){
						?>
						</tr>
						<?php $temp=0;
						} } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php include('include/footer.php'); ?>
		</td>
	</tr>
</table>
</body>
</html>
