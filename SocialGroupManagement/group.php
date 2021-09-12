<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	if(isset($_GET['gid'])){
		$gid=$_GET['gid'];
	}
	else{
		$gid=$_SESSION['groupid'];
	}
	$_SESSION['groupid']=$gid;
	$sql="select * from tbl_group where id='$gid'";
	$rs=mysql_query($sql);
	$row=mysql_fetch_array($rs);
	$query="select * from tbl_user where id='".$row['ownerid']."'";
	$rs1=mysql_query($query);
	$data=mysql_fetch_array($rs1);
	$flag=0;
	$sql3="select * from tbl_grouplist where groupid='".$gid."' and userid='".$_SESSION['id']."'";
	$r=mysql_query($sql3);
	if(mysql_num_rows($r)>0){
		$flag=1;
	}
	
	if(isset($_POST['submit1']) AND ($_POST['submit1']=='share')){
		$type="message";
		$msgbody=$_POST['msgbody'];
		$posterid=$_SESSION['id'];
		$time_offset ="165"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$time = date("H:i:s ",time() + $time_a);
		$date=date('Y-m-d');
		$displaystatus=1;
		$status=1;
		$sql1="insert into tbl_grouppost(groupid,posterid,type,messagebody,time,date,displaystatus,status) values('$gid','$posterid','$type','$msgbody','$time','$date','$displaystatus','$status')";
		mysql_query($sql1);
		header('location:group.php?a=1&gid='.$_SESSION['groupid'].'');
	}
	if(isset($_POST['submit2']) AND ($_POST['submit2']=='share')){
		$type="photo";
		$msgbody=$_POST['imgmsg'];
		$posterid=$_SESSION['id'];
		$time_offset ="165"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$time = date("H:i:s ",time() + $time_a);
		$date=date('Y-m-d');
		$displaystatus=1;
		$status=1;
		$sql1="insert into tbl_grouppost(groupid,posterid,type,messagebody,time,date,displaystatus,status) values('$gid','$posterid','$type','$msgbody','$time','$date','$displaystatus','$status')";
		mysql_query($sql1);
		
		//UPLOAD IMAGE STARTS
		$query="select MAX(Id) as max from tbl_grouppost";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$id=$row['max'];
		$uploaddir = 'groups/'.$gid.'/grouppics/';
		$_FILES['uploadedfile']['name']=$id.".jpg";
		
		$uploadfile = $uploaddir . basename($_FILES['uploadedfile']['name']);

		move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadfile);
		header('location:group.php?a=1&gid='.$_SESSION['groupid'].'');
		//UPLOAD IMAGE ENDS
		
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $row['name']; ?></title>
<link rel="stylesheet" href="comment_style.css" type="text/css" media="screen"/>
<link href="paint/whiteboard.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="paint/whiteboard.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="home.js"></script>
<script type="text/javascript" src="comment.js"></script>
<style>
#prof
{	list-style-type: none;
}
#prof > li
{
	float: left;
	margin-right:5px;
	margin-left:5px;
}
.prev, .next
{	opacity: 0.5;
}
.prev:hover, .next:hover
{	opacity: 1.0;
}
.start {
position: absolute;
left: 0;
top: 0;
z-index: 10;
}
.end {
position: absolute;
left: 0;
top: 0;
}
#post
{	opacity:0.5;
}
#post:hover
{	opacity:1.0;
}
.buttons
{	height:25px; width:80px; opacity:0.5;
}
.buttons:hover
{	opacity:1.0;
}
#xo, #yo
{	padding:5px;
	opacity:0.7;
}
#xo:hover, #yo:hover
{	opacity:1.0;
}
#antonio
{	position:absolute;
	z-index:100;
	top:25px;
	left:7px;
	color:transparent;
	cursor:pointer;
	text-decoration:none;
}
#gracias:hover #antonio
{	color:#000000;
	opacity:0.5;
	background-color:#CCCCCC;
}
#gracias #antonio:hover
{	opacity:1.0;
}
#enemigo
{	display:none;
	position:absolute;
	top:40%;
	left:45%;
}
#pathw
{	font-family:Arial; font-size:14px; margin:0px; padding:0px; text-decoration:none; color:#000000;
}
.commenta
{	display:none;
}
</style>
<script type="text/javascript" src="jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
$(document).ready(function(){
$("#pathw").click(function(){
	$("#enemigo").fadeIn("slow");
	});
$('#prof > li:gt(4)').hide();
$('.prev').hover(function() {
    var first = $('#prof').children('li:visible:first');
    first.prevAll(':lt(5)').fadeIn(1000);
    first.prev().nextAll().fadeOut(1000);
	
});
$('.next').hover(function() {
    var last = $('#prof').children('li:visible:last');
    last.nextAll(':lt(5)').fadeIn(1000);
    last.next().prevAll().fadeOut(1000);
});

$("img.start").hover(
function() {
$(this).stop().animate({"opacity": "0"},  "slow");
},
function() {
$(this).stop().animate({"opacity": "1"},  "slow");
});

$('#y').hide();
$('#xo').click(function(){
	$('#y').hide();
	$('#x').show();
});
$('#yo').click(function(){
	$('#x').hide();
	$('#y').show();
});

	$("#g3").hide();
	$("#g1").hide();
	$("#g2").hide();
	
	<?php if($_GET['a']==1){ ?>
		$("#g2").show();
	<?php }
		else{
	?>
		$("#g1").show();
	<?php } ?>
$('.buttons').click(function(){
	var id=$(this).attr("rel");
	if(id=="g1")
	{	$('#g2').hide(); $('#g3').hide();	}
	if(id=="g2")
	{	$('#g1').hide(); $('#g3').hide();	}
	if(id=="g3")
	{	$('#g1').hide(); $('#g2').hide();	}
	$("#"+id).fadeIn();
	});
	
	$("#antonio").fancybox({});
	

});
function closeIt(){
    		 $('#enemigo').fadeOut("slow");
}
</script>

</head>

<body background="images/body_background.jpg">
<?php
				if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  			//we give the value of the starting row to 0 because nothing was found in URL
			  $startrow = 0;
			//otherwise we take the value from the URL
			} else {
 				 $startrow = (int)$_GET['startrow'];
			}	
?>
<iframe id="enemigo" frameborder="0" src="groupinfo.php" height="160" width="200" style="background-color:#FFFFFF;"></iframe>
<table width="100%" border="0">
  <tr>
    <td colspan="2">
				<?php include('include/upperhead.php');?>
				<br />
	</td>
  </tr>
  <tr>
  	<td>
		<table width="100%" border="0">
			<tr>
				<td>
				<table border="0">
					<tr>
						<td style="width:200px">
		<p style="font-family:Pristina; font-size:28px; margin:0; position:relative;"><u><?php echo $row['name']; ?></u></p>
						</td>
						<?php
							if($row['ownerid']==$_SESSION['id']){
						?>
						<td width="50">
		<a href="#" id="pathw">Edit</a>
						</td>
						<td>
		<a href="deletegroup.php?gid=<?php echo $gid; ?>"><img src="images/delete.png" /></a>
						</td>
						<?php
							}
						?>
					</tr>
				</table>
		
				</td>
				<td rowspan="2">
					<table cellpadding="5px">
						<tr>
							<td>
								<img id="xo" src="images/message.png" /><br />
								<img id="yo" src="images/picture.png" />
							</td>
							<td>
								<form name="frmgp" action="" method="post" enctype="multipart/form-data">
									<div id="x">
										<textarea name="msgbody" placeholder="Post a message in group" rows="5" cols="30"></textarea>
										<input type="submit" name="submit1" value="share" /><br />
									</div>
									<div id="y">
										 <input type="file"  name="uploadedfile" id="file" /><br />
										<textarea  name="imgmsg" placeholder="Message" rows="3" cols="30"></textarea>
										<input type="submit"  name="submit2" value="share" />
									</div>
								</form>
							</td>
						</tr>
					</table>
				</td>
				<td rowspan="2">
					<div id="gracias" style="position:relative">
					<?php 
						if($_SESSION['id']==$row['ownerid']){
					?>
						<a  href="changegroupimage.php?gid=<?php echo $gid; ?>" id="antonio">Change pic</a>
						<?php
						}
							$grpname="groups/".$gid."/profilepics/".$gid.".jpg";
							if(!file_exists ( $grpname )){
						?>
						<img src="images/default-group-image.gif" style="height:100px; width:100px;" />
						<?php 
							}
							else{
						?>
						<img src="groups/<?php echo $row['id']; ?>/profilepics/<?php echo $row['id']; ?>.jpg" style="height:100px; width:100px;" />
						<?php
							}
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<img class="buttons" rel="g1" src="images/gabout.png" />
					<?php 
						if($flag==1){
					?>
					<img class="buttons" rel="g2" src="images/gposts.png" />
					<?php
						}
						if($flag==1){
							if($row['ownerid']!=$_SESSION['id']){
					?>
					<a href="groupunjoin.php?gid=<?php echo $gid; ?>"><img class="buttons" src="images/gunjoin.png"  /></a>
					<?php
							}
						}
						else{
					?>
					<a href="groupjoin.php?gid=<?php echo $gid; ?>"><img class="buttons" src="images/gjoin.png" /></a>
					<?php
						}
						if($flag==1){
					?>
					<img class="buttons" rel="g3" src="images/paint.png" />
					<?php 
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div id="g1">
						<table>
							<tr>
								<td>
									About:
								</td>
								<td>
									<?php echo $row['description']; ?>
								</td>
							</tr>
							<tr>
								<td>
									Creator:
								</td>
								<td>
									<?php echo $data['name']; ?>
								</td>
							</tr>
							<tr>
								<td>
									Members:
								</td>
								<td>
									<?php echo $row['noofmembers']; ?>
								</td>
							</tr>
						</table>
					</div>
					<div id="g2">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<?php
  										$prev = $startrow - 5;
										if ($prev >= 0)
    									echo '<a class="linka" href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'&?gid='.$gid.'">Previous posts</a>'; 
									?>
								</td>
							</tr>
							<?php
								$sql2="select * from tbl_grouppost  where groupid='$gid' order by id desc LIMIT $startrow, 5";
								$rs2=mysql_query($sql2);
								while($row2=mysql_fetch_array($rs2)){
									$query2="select * from tbl_user where id='".$row2['posterid']."'";
									$rs3=mysql_query($query2);
									$data3=mysql_fetch_array($rs3);
							?>
							<tr>
								<td>
									<table border="0">
										<tr>
											<td style="width:60px">
			<div style="width:56px; border:#CCCCCC groove; text-align:center; padding:5px; font-family:calibri; font-size:14px">
				<?php
					$filename="users/".$data3['id']."/profilepics/thumbnail_pic.jpg";
					$filename1="users/".$data3['id']."/profilepics/resized_pic.jpg";
					if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data3['gender']=='male')){
				?>
				<img src="images/profile_pic.jpg" width="40" height="40"  />	
				<?php
					}
					else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data3['gender']=='female')){
				?>
				<img src="images/profile_pic_f.jpg" width="40" height="40"  />	
				<?php
					}
					else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
				?>
				
				<img src="users/<?php echo $data3['id']; ?>/profilepics/resized_pic.jpg" width="40" height="40"  />
				
				
				<?php
					}
					else{
				?>
				
				<img src="users/<?php echo $data3['id']; ?>/profilepics/thumbnail_pic.jpg" width="40" height="40"  />
				<?php
					}
				?>
				<br />
							<?php echo $data3['name']; ?>
							</div>
					  	</td>
						<td style="width:600px">
							<p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;">has posted</p>
								
							<div style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; word-wrap:break-word; width:550px">
									
									<?php 
										echo $row2['messagebody']; 
										if($row2['type']=='photo'){
									?>
									<br /><br />
									<img src="groups/<?php echo $gid; ?>/grouppics/<?php echo $row2['id']; ?>.jpg" style="height:100px; width:auto" />
									<?php
										}
									?>
							
							</div>
					  </td>
					  <td>
					  	<?php
							if(($_SESSION['id']==$row2['posterid']) OR ($_SESSION['id']==$row['ownerid'])){
						?>
					  	<a href="deletegrouppost.php?pid=<?php echo $row2['id']; ?>&type=<?php echo $row2['type']; ?>&gid=<?php echo $gid; ?>"><img src="images/delete1.png" /></a>
						<?php
							}
						?>
					  </td>
					</tr>
					<?php
					//FOR POSTING COMMENT AGINST GROUP POST
					if(isset($_POST['submit']) AND ($_POST['submit']==$row2['id'])){
						
						$userid=$_SESSION['id'];
						$comment=$_POST['comment'];
						$time_offset ="165"; // Change this to your time zone
						$time_a = ($time_offset * 120);
						$time = date("H:i:s ",time() + $time_a);
						$date=date('Y-m-d');
						$status=1;
						$sqlc="insert into tbl_grouppostcomments(groupid,postid,userid,comment,date,time,status) values('$gid','".$row2['id']."','$userid','$comment','$date','$time','$status')";
					
						mysql_query($sqlc);
					}
				?>
					<tr>
						<?php 
							$date1=$row2['date'];
							list($yu,$mu,$du)=explode('-',$date1);
							$postdate=$du.'/'.$mu.'/'.$yu;
							$time1=$row2['time'];
							list($hu,$iu,$su)=explode(':',$time1);
							if($hu>12){
								$hu=$hu-12;
								$posttime=$hu.':'.$iu.'PM';
							}
							else{
								$posttime=$hu.':'.$iu.'PM';
							}
						?>
						<td width="20%">
							<p style="font-size:10px"><?php echo $postdate; ?></p>
							<p style="font-size:10px"><?php echo $posttime; ?></p>
						</td>
						<td>
						<p class="moim" style="font:Andalus; font-size:12px; float:left; padding-right:10px; cursor:pointer;">
						Add new comment</p>
						<div class="moima" style="display:none;">
						<form name="formcmnt" action="" method="post">
							<textarea name="comment" placeholder="Enter comment" rows="1" cols="25" style="background-color:transparent; border:#000000 groove;">
							</textarea>
							
							<input type="image" src="images/post.png" name="submit" value="<?php echo $row2['id']; ?>" style="font-size:12px; text-align:center; color:transparent"/>
						</form>
						</div>
						<p class="incomment" style="font:Andalus; font-size:12px; cursor:pointer">Comments</p>
						<!-- Comments start -->
						<div class="commenta">
							<ol class="message_list">
							<?php
								$query2="select * from tbl_grouppostcomments where postid='".$row2['id']."' ORDER BY time DESC ";
								$result2=mysql_query($query2);
								while($data2=mysql_fetch_array($result2)){
									$commenttime=$data2['time'];
									$time_offset ="165"; // Change this to your time zone(previously it was 525)
									$time_a = ($time_offset * 120);
									$currenttime = date("H:i:s ",time() + $time_a);
									
									/*$date = date("H:i:s ",time() + $time_a);
					
									echo $date;*/
					
									/*date_default_timezone_set('UTC');
									echo date(DATE_RFC822);*/
									/*echo date('h:i a',time()+ $time_a);
									echo date('G:i ',time()+ $time_a);*/
									
									//exploding current time
									list($hour,$mins,$secs) = explode(':',$currenttime);
									$currentsec=($hour*3600)+($mins*60)+$secs;
									
									//exploding comment time
									list($hour1,$mins1,$secs1) = explode(':',$commenttime);
									$commentsec=($hour1*3600)+($mins1*60)+$secs1;
									
									$timegap=$currentsec-$commentsec;
									
									$commentdate=$data2['date'];
									//exploding comment date
									
									list($year,$month,$day)=explode('-',$commentdate);
									$commentday=$day;
									$commentmonth=$month;
									$commentyear=$year;
									
									$currentdate=date('d-m-Y');
									//exploding current date
									list($day1,$month1,$year1)=explode('-',$currentdate);
									$currentday=$day1;
									$currentmonth=$month1;
									$currentyear=$year1;
									
									$sqlu="select * from tbl_user where id='".$data2['userid']."'";
									$resultu=mysql_query($sqlu);
									$datau=mysql_fetch_array($resultu);
							?>
		<li>
		<p class="message_head"><cite><?php echo $datau['name']; ?>:</cite> <span class="timestamp">
		<?php
			if($commentday!=$currentday || $commentmonth!=$currentmonth || $commentyear!=$currentyear){
				if($hour1<12)
					echo $commentday.'/'.$commentmonth.'/'.$commentyear.' at '.$hour1.':'.$mins1." AM";
				else{
					$newhour1=sprintf("%02s", $hour1-12);
					echo $commentday.'/'.$commentmonth.'/'.$commentyear.' at '.$newhour1.':'.$mins1." PM";
					
				}
			}
			else{
				if($timegap>=3600){
					$hourgap=intval($timegap/3600);
					echo "About ".$hourgap." hours ago";
				}
				else if($timegap>=60){
					$mingap=intval($timegap/60);
					echo "About ".$mingap." minutes ago";
				}
				else if($timegap<60){
					$secgap=$timegap;
					echo "About ".$secgap." seconds ago";
				}
			}
		?>
		</span></p>
		<div class="message_body">
			<p><?php echo $data2['comment']; ?></p>
			<p style="font-family:Verdana; font-size:10px;">
			 <?php
				if(($_SESSION['id']==$data2['userid']) || ($_SESSION['id']==$data['id'])){
			?>
			<a href="deletegroupcomment.php?id=<?php echo $data2['id']; ?>" style="text-decoration:none;color:#000000">delete</a>
			<?php
				}
			?>
			</p>
		</div>
		</li>
		<?php
			}
		?>
		

							</ol>
</div>
				<!-- comments end -->
						</td>
						<td>
						</td>
					</tr>
					<hr />
			  </table>
			</td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td colspan="2">
				<?php
					$sqln="select * from tbl_grouppost where groupid='$gid'";
					$resultn=mysql_query($sqln);
					$numn=mysql_num_rows($resultn);
					$next=$startrow+5;
					if($next<($numn))
						echo '<a class="linka" href="'.$_SERVER['PHP_SELF'].'?startrow='.$next.'&?gid='.$gid.'">Older posts</a>';
				?>
			</td>
		</tr>
	</table>
					</div>
					<div id="g3">
						<iframe src="whiteboard/index.html" height="350" width="320" frameborder="0" style="background-color:#FFFFFF"></iframe>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<table width="100%" border="0" cellpadding="1px">
  						<tr>
    						<td width="60px"><img class="prev" src="images/fbutton.png" />
							</td>
							<td>
								<ul id="prof">
								<?php 
									$sql4="select * from tbl_grouplist where groupid='$gid'";
									$rs4=mysql_query($sql4);
									while($data4=mysql_fetch_array($rs4)){
										$sql5="select * from tbl_user where id='".$data4['userid']."'";
										$rs5=mysql_query($sql5);
										$row5=mysql_fetch_array($rs5);
								?>
	 								<li>
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<?php
													$filename="users/".$row5['id']."/profilepics/thumbnail_pic.jpg";
													$filename1="users/".$row5['id']."/profilepics/resized_pic.jpg";
													if(!file_exists ( $filename ) && !file_exists ( $filename1 )  && ($row5['gender']=='male')){
												?>
												<a href="oprofile.php?id=<?php echo $row5['id'];?>"><img src="images/profile_pic.jpg" width="100" height="100"  />	</a>
												<?php
													}
													else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($row5['gender']=='female')){
												?>
												<a href="oprofile.php?id=<?php echo $row5['id'];?>"><img src="images/profile_pic_f.jpg"  width="100" height="100"  />	</a>
												<?php
													}
													else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
												?>
												
												<a href="oprofile.php?id=<?php echo $row5['id'];?>"><img src="users/<?php echo $row5['id']; ?>/profilepics/resized_pic.jpg" width="100" height="100"  /></a>
												
												
												<?php
													}
													else{
												?>
												
												<a href="oprofile.php?id=<?php echo $row5['id'];?>"><img src="users/<?php echo $row5['id']; ?>/profilepics/thumbnail_pic.jpg" width="100" height="100"  /></a>
												
												</div>
												<?php
													}
												?>
											</tr>
											<tr>
												<td><?php echo $row5['name']; ?></td>
											</tr>
										</table>
									</li>
									<?php
									}
									?>
								</ul>
							</td>
    						<td width="60px"><img class="next" src="images/bbutton.png" />
							</td>
  						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
	<td>
		<table border="0" cellpadding="0" cellspacing="0" height="500">
			<tr>
				<td>
					<?php include('rightsides.php'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php include('onlinefriends.php'); ?>
				</td>
			</tr>
			<tr>
				<td>
				</td>
			</tr>
		</table>
	</td>
  </tr>
</table>
</body>
</html>