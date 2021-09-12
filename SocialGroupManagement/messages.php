<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$flag=0;
	if(isset($_POST['submit']) AND ($_POST['submit']=="Important")){
		$sql3="select * from (select * from tbl_thread where (initiatorid='".$_SESSION['id']."' and initiatorstatus='1') or (receiverid='".$_SESSION['id']."' and receiverstatus='1')) AS A where impstatus='1' order by id desc";
	}
	else if(isset($_GET['uid'])){
		
		$sql3="(select * from tbl_thread where initiatorid='".$_GET['uid']."' and receiverid='".$_SESSION['id']."' and receiverstatus=1) union (select * from tbl_thread where receiverid='".$_GET['uid']."' and initiatorid='".$_SESSION['id']."' and initiatorstatus=1) order by id desc";
	}
	else{
		$sql3="select * from tbl_thread where (initiatorid='".$_SESSION['id']."' and initiatorstatus='1') or (receiverid='".$_SESSION['id']."' and receiverstatus='1') order by id desc";
	}

	$rs3=mysql_query($sql3);
	if(isset($_POST['submit']) AND ($_POST['submit']=="Create")){
		$initiator=$_SESSION['id'];
		$subject=$_POST['subject'];
		$receiver=$_POST['receiver'];
		$creationdate=date('Y-m-d');
		$time_offset ="165"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$creationtime = date("H:i:s ",time() + $time_a);
		$noofmessages=0;
		$lastmessagedate=date('Y-m-d');
		$initiatorstatus=1;
		$receiverstatus=1;
		$impstatus=0;
		$status=1;
		$sql1="select * from tbl_user where name='".$receiver."'";
		$rs1=mysql_query($sql1);
		$row1=mysql_fetch_array($rs1);

		$sql="insert into tbl_thread(initiatorid,receiverid,subject,creationdate,creationtime,noofmessages,lastmessagedate,initiatorstatus,receiverstatus,impstatus,status) values('$initiator','".$row1['id']."','$subject','$creationdate','$creationtime','$noofmessages','$lastmessagedate','$initiatorstatus','$receiverstatus','$impstatus','$status')";
		$rs=mysql_query($sql);
		$sql2="select MAX(id) as max from tbl_thread";
		$rs2=mysql_query($sql2);
		$row2=mysql_fetch_array($rs2);
		header('location:thread.php?tid='.$row2['max']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Messages</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="home.js"></script>
<script type="text/javascript" src="jquery.watermarkinput.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.imp').hover(function(){
			if($(this).attr("src")=="images/star.png")
				$(this).attr("src","images/stari.png");
			else
				$(this).attr("src","images/star.png");
		});
		
		/* search code */
		$(".searchm").keyup(function() 
		{	var searchbox = $(this).val();
			var dataString = 'searchword='+ searchbox;
			if(searchbox==''){$("#displaym").hide();}
			else{
				$.ajax({
					type: "POST",
					url: "searchthread.php",
					data: dataString,
					cache: false,
					success: function(html){ $("#displaym").html(html).show(); }
				});
			}return false;    
		});
		
		$("#searchboxm").Watermark("Find");
		 
		 /* end search code */
		
	});
	
</script>
<style>
*
{	margin:0px;
	padding:0px;
}
p
{	
	  font-family:Andalus;
	font-size:16px;
	}
.antr
{	 margin: 0;
     padding: 0;
	 opacity:0.5;
}
.antr:hover
{	opacity:1.0;
}
/* for show threads of */
#searchboxm
{
width:170px;
border:solid 1px #000;
padding:3px;
float:left;
font-family:Arial;
font-size:14px;
background-color:transparent;
}
#displaym
{
width:180px;
display:none;
float:right;
margin-top:5px;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
z-index:100;
position:absolute;
background-color: #FFFFFF;
}
.display_boxm
{
padding:4px; border-top:solid 1px #dedede; font-size:12px; height:30px;
}

.display_boxm:hover
{
background:#E0E0E0;
color:#FFFFFF;
}
#shadem
{
background-color:#00CCFF;

}
/* end for show threads of */
</style>
</head>

<body background="images/body_background.jpg">
<table border="0" style="padding:20px">
	<tr>
		<td colspan="5">
			<?php include('include/upperhead.php');?>
			<br /><br />
		</td>
	</tr>
	<tr>
		<form name="formmsg" action="" method="post">
		<td width="500" style="padding:10px">
			<table style="border:#000000 dotted; padding:5px">
				<tr>
					<td>
						<p>Subject : <input type="text" name="subject" /> </p>
					</td>
					<td>
						<p>With : <input type="text" name="receiver" /> </p>
					</td>
					<td>
						<input type="image" src="images/createt.png" name="submit" value="Create" />
					</td>
				</tr>
			</table>
		</td>
		<td width="50" style="padding:10px">
			<input type="image" src="images/important.png" name="submit" value="Important" />
		</td>
		<td width="50" style="padding:10px">
			<a href="messages.php"><input type="image" src="images/msgall.png" name="" value="" /></a>
		</td>
		<td style="padding:10px">
			<table style="border:#000000 dotted">
				<tr>
					<td>
						<p>Show threads of : </p>
					</td>
					<td rowspan="2">
						<input type="image" src="images/search_mail.png" name="submit" value="Find" />
					</td>
				</tr>
				<tr>
					<td>
						<div style="width:200px; margin-left:10px">
						<input type="text" class="searchm" id="searchboxm" name="show" /><br />
						<div id="displaym"></div>
					</td>
				</tr>
			</table>
		</td>
		</form>
		<td rowspan="2">
			<?php include('rightsides.php'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<table border="0" width="100%">
			<!-- one element -->
			<?php
				while($row3=mysql_fetch_array($rs3)){
					$sql5="select * from tbl_messages where threadid='".$row3['id']."' and receiverid='".$_SESSION['id']."' and readstatus=0";
					$rs5=mysql_query($sql5);
					if(mysql_num_rows($rs5)>0){
						$flag=1;
					}
					list($y,$m,$d)=explode('-',$row3['creationdate']);
					$date=$d.'/'.$m.'/'.$y;
					list($hu,$iu,$su)=explode(':',$row3['creationtime']);
					if($hu>12){
						$hu=$hu-12;
						$time=$hu.':'.$iu.'PM';
					}
					else{
						$time=$hu.':'.$iu.'PM';
					}
					if($_SESSION['id']==$row3['initiatorid']){
						$sql4="select * from tbl_user where id='".$row3['receiverid']."'";
					}
					else if($_SESSION['id']==$row3['receiverid']){
						$sql4="select * from tbl_user where id='".$row3['initiatorid']."'";
					}
					$rs4=mysql_query($sql4);
					$row4=mysql_fetch_array($rs4);
			?>
			<tr class="antr">
					<td width="30">
						<?php
							if($row3['impstatus']==0){
						?>
						<a href="markimp.php?tid=<?php echo $row3['id']; ?>&value=1&source=messages"><img class='imp' src="images/star.png" height="30" width="30" /></a>
						<?php 
							}
							else{
						?>
						<a href="markimp.php?tid=<?php echo $row3['id']; ?>&value=0&source=messages"><img class='imp' src="images/stari.png" height="30" width="30" /></a>
						<?php
							}
						?>
					</td>
					<td width="200">
						<p style="font-family:Arial; font-size:12px"><?php echo $row3['subject']; ?></p>
					</td>
					<td width="100">
						<a href="updatereadstatus.php?tid=<?php echo $row3['id']; ?>" style="font-family:Arial; font-size:12px; color:#000000" >View</a>
					</td>
					<td style="font-size:12px">
						<?php 
							if($flag==1){
								echo "1 new message";
							}
						?>
					</td>
					<td width="30">
						<p style="font-family:Arial; font-size:12px">with:</p>
					</td>
					<td width="30">
						<?php
						$filename="users/".$row4['id']."/profilepics/thumbnail_pic.jpg";
						$filename1="users/".$row4['id']."/profilepics/resized_pic.jpg";
						if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($_SESSION['gender']=='male')){
						?>
						<img src="images/profile_pic.jpg" width="30" height="30"  />	
						<?php
							}
						else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($_SESSION['gender']=='female')){
						?>
						<img src="images/profile_pic_f.jpg" width="30" height="30"  />	
						<?php
							}
						else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
						?>
						<img src="users/<?php echo $row4['id']; ?>/profilepics/resized_pic.jpg" width="30" height="30"  />
						<?php
							}
							else{
						?>
						<img src="users/<?php echo $row4['id']; ?>/profilepics/thumbnail_pic.jpg" width="30" height="30"  />
						<?php
							}
						?>
					</td>
					<td width="150">
						<p class="showme" style="font-family:Arial; font-size:12px"><?php echo $row4['name']; ?></p>
					</td>
					<td width="100">
						<p style="font-family:Arial; font-size:12px"><?php echo $date." at ".$time; ?></p>
					</td>
					<td width="20">
						<a href="deletethread.php?tid=<?php echo $row3['id']; ?>"><img src="images/delme.png" /></a>
					</td>
				</tr>
				<?php
					}
				?>
				<!-- one element end -->
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4"></td>
		<td><?php include('onlinefriends.php'); ?></td>
	</tr>
</table>
</body>
</html>
