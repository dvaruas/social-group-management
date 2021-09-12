<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$threadid=$_GET['tid'];
	$sql="select * from tbl_thread where id='$threadid'";
	$rs=mysql_query($sql);
	$row=mysql_fetch_array($rs);
	$sql1="select * from (select * from tbl_messages where (senderid='".$_SESSION['id']."' and senderstatus='1') or (receiverid='".$_SESSION['id']."' and receiverstatus='1')) AS A where threadid='$threadid'";
	$rs1=mysql_query($sql1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $row['subject']; ?></title>
<script type="text/javascript" src="jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#replier").fancybox({
			'onClosed': function(){parent.location.reload(true);}
  		});
		
		$('.imp').hover(function(){
			if($(this).attr("src")=="images/star.png")
				$(this).attr("src","images/stari.png");
			else
				$(this).attr("src","images/star.png");
		});
		
	});
	
</script>
<style>
p
{	
	margin: 0;
    padding: 0;
	font-family:Arial;
	font-size:14px;
	text-align:center;
	word-wrap:break-word;
	}
.antr
{	 opacity:0.5;
}
.antr:hover
{	opacity:1.0;
}

</style>
</head>

<body background="images/body_background.jpg">
<table border="0">
	<tr>
		<td colspan="4">
			<?php include('include/upperhead.php');?>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" style="width:700px;">
			<tr>
				<td style="text-align:center">
					<?php
						if($row['impstatus']==0){
					?>
					<a href="markimp.php?tid=<?php echo $row['id']; ?>&value=1&source=thread"><img class='imp' src="images/star.png" height="30" width="30" /></a>
					<?php 
						}
						else{
					?>
					<a href="markimp.php?tid=<?php echo $row['id']; ?>&value=0&source=thread"><img class='imp' src="images/stari.png" height="30" width="30" /></a>
					<?php
						}
					?>
				</td>
				<td colspan="2">
					<p><?php echo $row['subject']; ?></p>
				</td>
				<td style="text-align:center">
					<a href="deletethread.php?tid=<?php echo $threadid; ?>"><img class="antr" src="images/delme.png" /></a>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<hr />
				</td>
			</tr>
			<!-- one message start -->
			<?php
				while($row1=mysql_fetch_array($rs1)){
					$sql2="select * from tbl_user where id='".$row1['senderid']."'";
					$rs2=mysql_query($sql2);
					$row2=mysql_fetch_array($rs2);
			?>
			<tr>
				<td rowspan="2" width="60">
					
					<?php
						$filename="users/".$row2['id']."/profilepics/thumbnail_pic.jpg";
						$filename1="users/".$row2['id']."/profilepics/resized_pic.jpg";
						if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($row2['gender']=='male')){
					?>
					<img src="images/profile_pic.jpg" width="50" height="50"  />	
					<?php
						}
						else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($row2['gender']=='female')){
					?>
					<img src="images/profile_pic_f.jpg" width="50" height="50"  />	
					<?php
						}
						else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
					?>
					
					<img src="users/<?php echo $row2['id']; ?>/profilepics/resized_pic.jpg" width="50" height="50"  />
					
					
					<?php
						}
						else{
					?>
					
					<img src="users/<?php echo $row2['id']; ?>/profilepics/thumbnail_pic.jpg" width="50" height="50"  />
					
					<?php
						}
					?>
				</td>
				<td>
					<p style="float:left"><?php echo $row2['name']; ?></p>
				</td>
				<td width="20">
					<p style="font-size:10px">24/4/2012</p>
					<p style="font-size:10px">10:40pm</p>
				</td>
				<td style="text-align:center;">
					<a href="deletemsg.php?msgid=<?php echo $row1['id']; ?>&tid=<?php echo $threadid; ?>"><img class="antr" src="images/delmsg.png" /></a>
				</td>
			</tr>
			<tr>
				<td rowspan="2" colspan="2" style="border-bottom:#000000 dotted">
				<div style="width:550px">
					<p style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left">
					<?php echo $row1['body']; ?>
					</p>
				</div>
				</td>
				<td rowspan="2" style=" border-bottom:#000000 dotted">
				</td>
			</tr>
			<tr>
				<td style="border-bottom:#000000 dotted">
				</td>
			</tr>
			<?php
				}
			?>
			<!-- one message end -->
			
			<tr>
				<td colspan="4" style="text-align:center">
					<a id="replier" href="msgwrite.php?tid=<?php echo $threadid; ?>" style="text-decoration:none"><img src="images/reply.png" /></a>
				</td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
