<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$count=0;
	$s="select * from tbl_user where id='".$_SESSION['id']."'";
	$r=mysql_query($s);
	$rw=mysql_fetch_array($r);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome <?php echo $rw['name']; ?></title>
<link rel="stylesheet" href="home_style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="comment_style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="home.js"></script>
<script type="text/javascript" src="comment.js"></script>
<style>
.linka
{	opacity:0.7;
}
.linka:hover
{	opacity:1.0;
}
.commenta
{	display:none;
}
</style>
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
			$temp=$startrow+5;
?>
<table border="0" cellpadding="0">
  <tr>
    <td colspan="2">
		<?php include('include/upperhead.php');?>
		<br /><br />
	</td>
  </tr>
	<tr>
  <td rowspan="2" align="center">
  		
	<table border="0" cellpadding="0" cellspacing="0">
	
			<?php
			
			$ide=$_SESSION['id'];
			
			$sql1="(select id, id wer, userid, date, time, type, description, displaystatus from tbl_updates where userid='$ide' or userid in(select acceptorid from tbl_friendlist where requesterid='$ide')) union(select id, groupid, posterid, date, time, type, messagebody, displaystatus from tbl_grouppost where groupid in(select groupid from tbl_grouplist where userid='$ide')) order by date desc, time desc";
			$sqlcount="select sum(c) as counter from (select count(*) as c from tbl_updates where userid='$ide' or userid in(select acceptorid from tbl_friendlist where requesterid='$ide') union select count(*) from tbl_grouppost where groupid in(select groupid from tbl_grouplist where userid='$ide')) as dummy";
			$resultcount=mysql_query($sqlcount);
			$rowcount=mysql_fetch_array($resultcount);
			$result=mysql_query($sql1); 
			$temp1=0;
			$start=$startrow;
			while($row=mysql_fetch_array($result) AND $startrow<$temp){
				if($temp1<$start)
				{	
					$temp1++;
					continue;
				}
				$userid=$row['userid'];
				$sql2="select * from tbl_user where id='$userid'";
				$result1=mysql_query($sql2);
				$data=mysql_fetch_array($result1);
		?>
		<tr>
			<td>
				<table border="0">
					<tr>
						<td width="60">
			<div style="width:56px; border:#CCCCCC groove; text-align:center; padding:5px; font-family:calibri; font-size:14px">
				<?php
					$filename="users/".$data['id']."/profilepics/thumbnail_pic.jpg";
					$filename1="users/".$data['id']."/profilepics/resized_pic.jpg";
					if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data['gender']=='male')){
				?>
				<img src="images/profile_pic.jpg" width="40" height="40"  />	
				<?php
					}
					else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data['gender']=='female')){
				?>
				<img src="images/profile_pic_f.jpg" width="40" height="40"  />	
				<?php
					}
					else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
				?>
				
				<img src="users/<?php echo $data['id']; ?>/profilepics/resized_pic.jpg" width="40" height="40"  />
				
				
				<?php
					}
					else{
				?>
				
				<img src="users/<?php echo $data['id']; ?>/profilepics/thumbnail_pic.jpg" width="40" height="40"  />
				
				<?php
					}
				?><br />
							<?php echo $data['name']; ?>
			</div>
					  	</td>
						<td width="600" style="padding:10px">
							<p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;">has posted</p>
								<?php
							if($row['type']=="message"){ ?>
							<div style="font-family:Geneva; font-size:16px; font-weight:bold; word-wrap:break-word; width:550px">
							
							<?php		echo $row['description'];
							}
							else if($row['type']=="photo"){	
								if($row['displaystatus']==0){
									echo $row['description'];
							?><br /><br />
			<img src="users/<?php echo $data['id']; ?>/statusimages/<?php echo $row['id']; ?>.jpg" style="height:100px; width:auto" />
							<?php 
								}
								else if($row['displaystatus']==1){
									echo $row['description'];
							?><br /><br />
					<img src="groups/<?php echo $row['wer']; ?>/grouppics/<?php echo $row['id']; ?>.jpg" style="height:100px; width:auto" />		
							<?php
								}
							}
							?>
							</div>
							<?php
								if(isset($_POST['submit']) AND ($_POST['submit']==$row['id'])){
									//FOR COMMENT
									$userid=$_SESSION['id'];
									$comment=$_POST['comment'];
									$time_offset ="165"; // Change this to your time zone
									$time_a = ($time_offset * 120);
									$time = date("H:i:s ",time() + $time_a);
									$date=date('Y-m-d');
									$status=1;
									if($row['displaystatus']==0){
										$sql="insert into tbl_comments(updateid,userid,commenttime,commentdate,comment,status) values('".$row['id']."','$userid','$time','$date','$comment','$status')";
									}
									else if($row['displaystatus']==1){
										$sql="insert into tbl_grouppostcomments(groupid,postid,userid,comment,date,time,status) values('".$row['wer']."','".$row['id']."','$userid','$comment','$date','$time','$status')";
									}
									mysql_query($sql);
								}
							?>
					  </td>
					  <td width="10">
					  	<?php
							if($_SESSION['id']==$row['userid']){
						?>
						<?php
							if($row['displaystatus']==0){
						?>
					  	<a href="deletepost.php?postid=<?php echo $row['id']; ?>&a=1"><img src="images/delete1.png" /></a>
						<?php
							}
							else if($row['displaystatus']==1){
						?>
						<a href="deletegrouppost.php?pid=<?php echo $row['id']; ?>&s=1&type=<?php echo $row['type']; ?>&gid=<?php echo $row['wer']; ?>"><img src="images/delete1.png" /></a>
						<?php
							}
						?>
						<?php
							}
						?>
					  </td>
					</tr>
					<tr>
						<?php
							$date1=$row['date'];
							list($yu,$mu,$du)=explode('-',$date1);
							$statusdate=$du.'/'.$mu.'/'.$yu;
							$time1=$row['time'];
							list($hu,$iu,$su)=explode(':',$time1);
							if($hu>12){
								$hu=$hu-12;
								$statustime=$hu.':'.$iu.'PM';
							}
							else{
								$statustime=$hu.':'.$iu.'PM';
							}
						?>
						<td width="20%">
							<p style="font-size:10px"><?php echo $statusdate; ?></p>
							<p style="font-size:10px"><?php echo $statustime; ?></p>
						</td>
						<td>
						<p class="moim" style="font:Andalus; font-size:12px; float:left; padding-right:10px; cursor:pointer;">
						Add new comment</p>
						<div class="moima" style="display:none;">
						<form name="formcmnt" action="" method="post">
							<textarea name="comment" placeholder="Enter comment" rows="1" cols="25" style="background-color:transparent; border:#000000 groove;">
							</textarea>
							<input type="image" src="images/post.png" name="submit" value="<?php echo $row['id']; ?>" style="font-size:12px; text-align:center; color:transparent"/>
						</form>
						</div>
						<p class="incomment" style="font:Andalus; font-size:12px; cursor:pointer">Comments</p>
						<!-- Comments start -->
						<div class="commenta">
							<ol class="message_list">
	
		<?php
			if($row['displaystatus']==0){
				$query2="select * from tbl_comments where updateid='".$row['id']."' ORDER BY id DESC ";
			}
			else if($row['displaystatus']==1){
				$query2="select id,groupid,postid,userid,comment,date commentdate,time commenttime from tbl_grouppostcomments where postid='".$row['id']."' ORDER BY id desc ";
			}
			$result2=mysql_query($query2);
			while($data2=mysql_fetch_array($result2)){
				$commenttime=$data2['commenttime'];
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
				
				$commentdate=$data2['commentdate'];
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
				
				$sql3="select * from tbl_user where id='".$data2['userid']."'";
				$result3=mysql_query($sql3);
				$data3=mysql_fetch_array($result3);
		?>
		<li>
		<p class="message_head"><cite><?php echo $data3['name']; ?>:</cite> <span class="timestamp">
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
			<?php 
				if($row['displaystatus']==0){
			?>
			<a href="deletecomment.php?id=<?php echo $data2['id']; ?>" style="text-decoration:none;color:#000000">delete</a>
			<?php
				}
				else if($row['displaystatus']==1){
			?>
			<a href="deletegroupcomment.php?s=1&id=<?php echo $data2['id']; ?>" style="text-decoration:none;color:#000000">delete</a>
			<?php
				}
			?>
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
			$startrow++;
			}
		?>
		<tr>
			<td colspan="2">
				<table border="0" width="100%">
					<tr>
				<?php 
					$count=$rowcount['counter'];
					$x=$start-5;
					$y=$start+5;
					if($x<0)
						$x=0;
					if($y<$count){ 
					 ?>
					 <td width="80">
					<a href="<?php echo $_SERVER['PHP_SELF'].'?startrow='.$y; ?>"><img class="linka" src="images/prev.png" /></a>
					</td>
					<?php 
						} ?>
					<td>
					</td>
					<?php
					if($x>=0 && $start!=0){?>
					<td width="80">
					<a href="<?php echo $_SERVER['PHP_SELF'].'?startrow='.$x; ?>" ><img class="linka" src="images/next.png"></a>
					</td>
					<?php 
						}
					?>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	</td>
	
    <td height="150px">
		<br /><br />
	<center>
	<?php include('rightsides.php'); ?>
	</center>

	</td>
	</tr>
	<tr>
		<td>
			<?php include('onlinefriends.php'); ?>
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
