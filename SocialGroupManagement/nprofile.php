<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$s="select * from tbl_user where id='".$_SESSION['id']."'";
	$r=mysql_query($s);
	$rw=mysql_fetch_array($r);
	
	$query1="select * from tbl_personaldetails where userid='".$_SESSION['id']."'";
	$rs1=mysql_query($query1);
	$row1=mysql_fetch_array($rs1);
	
	$query2="select * from tbl_education where userid='".$_SESSION['id']."'";
	$rs2=mysql_query($query2);
	$row2=mysql_fetch_array($rs2);
	
	$query3="select * from tbl_interests where userid='".$_SESSION['id']."'";
	$rs3=mysql_query($query3);
	$row3=mysql_fetch_array($rs3);
	
	$query4="select * from tbl_contactinfo where userid='".$_SESSION['id']."'";
	$rs4=mysql_query($query4);
	$row4=mysql_fetch_array($rs4);
	
	$query5="select count(*) as count1 from tbl_friendlist where acceptorid='".$_SESSION['id']."'";
	$rs5=mysql_query($query5);
	$row5=mysql_fetch_array($rs5);
	$connectedtome=$row5['count1'];
	
	$query6="select count(*) as count2 from tbl_friendlist where requesterid='".$_SESSION['id']."'";
	$rs6=mysql_query($query6);
	$row6=mysql_fetch_array($rs6);
	$connectedwithme=$row6['count2'];
	
	$query7="select count(*) as count3 from tbl_grouplist where userid='".$_SESSION['id']."'";
	$rs7=mysql_query($query7);
	$row7=mysql_fetch_array($rs7);
	$groupcount=$row7['count3'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $rw['name']; ?></title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="home.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#exaf li').click(function(){
			$(this).find('table').slideToggle("slow");
		});
	});
</script>
<style>
*
{	margin:0px;
	padding:0px;
}
#exaf
{	list-style:none;
}
#exaf li table
{	display:none;
	font:DaunPenh;
	font-size:11px;
	padding:10px;
}
#exaf li
{	background-image:url(images/ha-header.jpg);
	background-repeat: no-repeat;
}
#exaf li a
{	font-family: Kokila;
	font-size:20px;
	text-decoration:none;
	color:#000000;	
	width:200px;
	padding:10px;
}
.eel
{
	font-family:Helvetica;
	font-size:12px;
	margin:0px;
	padding:0px;
}
.touche
{	opacity:0.7;
}
.touche:hover
{	opacity:1.0;
}
</style>
      
</head>

<body background="images/body_background.jpg">
<table border="0">
	<tr>
		<td colspan="3">
			<center>
			<?php include('include/upperhead.php'); ?>
			</center>
			<br />
		</td>
	</tr>
	<tr>
		<td width="600" style="padding:20px">
			<table>
				<tr>
					<td>
						<p style="font-family:Verdana; font-size:14px;"><?php echo $connectedtome; ?></p>
					</td>
					<td>
						<img class="touche" src="images/cwithp.png" />
					</td>
					<td>
						<img class="touche" src="images/ctop.png" />
					</td>
					<td>
						<p style="font-family:Verdana; font-size:14px;"><?php echo $connectedwithme; ?></p>
					</td>
					<td width="150">
					</td>
					<td>
						<img class="touche" src="images/Groups.png" />
					</td>
					<td>
						<p style="font-family:Verdana; font-size:14px;"><?php echo $groupcount; ?></p>
					</td>
			</table>
		</td>
		<td width="330" rowspan="2" style="padding:20px">
			<div style="width:300px; word-wrap:break-word; ">
			<ul id="exaf">
                <li>
                    <a href="#">Personal</a>
                           <table cellpadding="5" style="border-left-color:#000000; border-right-color:#000000; border-left-style:dashed; border-right-style:dashed;">
						   		<?php
										if($row1['aboutme']!=null)
										{
								?>
						   		<tr>
									<td>
										<p class="eel">About me:</p>
									</td>
									<td>
										<?php echo $row1['aboutme']; ?>
										
									</td>
								</tr>
								<?php
										}
										if($row1['languagesknown']!="Select"){
								?>
								<tr>
									<td>
										<p class="eel">Languages:</p>
									</td>
									<td>
										<?php echo $row1['languagesknown']; ?>
										
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td>
										<p class="eel">Gender:</p>
									</td>
									<td>
										<?php echo $row1['gender']; ?>
										
									</td>
								</tr>
								<?php if($row1['sexualorientation']!="Select"){ ?>
								<tr>
									<td>
										<p class="eel">Sexual orientation:</p>
									</td>
									<td>
										<?php echo $row1['sexualorientation']; ?>
										
									</td>
								</tr>
								<?php 
								}
								if($row1['relationshipstatus']!="Select"){ ?>
								<tr>
									<td>
										<p class="eel">Relationship status:</p>
									</td>
									<td>
										<?php echo $row1['relationshipstatus']; ?>
										
									</td>
								</tr>
								<?php } ?>
							</table>
                 </li>
				 <li>
                    <a href="#">Work & Education</a>
                    
                           <table cellpadding="5"  style="border-left-color:#000000; border-right-color:#000000; border-left-style:dashed; border-right-style:dashed">
						   		<?php if($row2['employee']!=null){ ?>
						   		<tr>
									<td>
										<p class="eel">Employee:</p>
									</td>
									<td>
										<?php echo $row2['employee']; ?>
										
									</td>
								</tr>
								<?php } 
								if($row2['postgraduation']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Post Graduation:</p>
									</td>
									<td>
										<?php echo $row2['postgraduation']; ?>
										
									</td>
								</tr>
								<?php } 
								if($row2['graduation']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Graduation:</p>
									</td>
									<td>
										<?php echo $row2['graduation']; ?>
										
									</td>
								</tr>
								<?php }
								if($row2['highschool']!=null){ ?>
								<tr>
									<td>
										<p class="eel">High School:</p>
									</td>
									<td>
										<?php echo $row2['highschool']; ?>
										
									</td>
								</tr>
								<?php }
								if($row2['primaryschool']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Primary School:</p>
									</td>
									<td>
										<?php echo $row2['primaryschool']; ?>
										
									</td>
								</tr>
								<?php } ?>
							</table>
                       
                </li>
				<li>
                    <a href="#">Interests</a>
                    
                           <table cellpadding="5"  style="border-left-color:#000000; border-right-color:#000000; border-left-style:dashed; border-right-style:dashed">
						   		<?php if($row3['favouritesports']!=null){ ?>
						   		<tr>
									<td>
										<p class="eel">Favourite sport:</p>
									</td>
									<td>
										<?php echo $row3['favouritesports']; ?>
										
									</td>
								</tr>
								<?php }
								if($row3['televisionshows']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Television show:</p>
									</td>
									<td>
										<?php echo $row3['televisionshows']; ?>
										
									</td>
								</tr>
								<?php }
								if($row3['favouritemusics']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Favourite music:</p>
									</td>
									<td>
										<?php echo $row3['favouritemusics']; ?>
										
									</td>
								</tr>
								<?php }
								if($row3['hobbies']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Hobbies/Interests:</p>
									</td>
									<td>
										<?php echo $row3['hobbies']; ?>
										
									</td>
								</tr>
								<?php }
								if($row3['favouritebooks']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Favourite books:</p>
									</td>
									<td>
										<?php echo $row3['favouritebooks']; ?>
										
									</td>
								</tr>
								<?php }
								if($row3['religiousview']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Religious views:</p>
									</td>
									<td>
										<?php echo $row3['religiousview']; ?>
										
									</td>
								</tr>
								<?php }
								if($row3['politicalview']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Political views:</p>
									</td>
									<td>
										<?php echo $row3['politicalview']; ?>
										
									</td>
								</tr>
								<?php } ?>
							</table>
                       
                </li>
				<li>
                    <a href="#">Contact Information</a>
                    
                           <table cellpadding="5"  style="border-left-color:#000000; border-right-color:#000000; border-left-style:dashed; border-right-style:dashed">
						   		<?php if($row4['emailid']!=null){ ?>
						   		<tr>
									<td>
										<p class="eel">E-mail id:</p>
									</td>
									<td>
										<?php echo $row4['emailid']; ?>
										
									</td>
								</tr>
								<?php }
								if($row4['cellphoneno']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Cell Number:</p>
									</td>
									<td>
										<?php echo $row4['cellphoneno']; ?>
										
									</td>
								</tr>
								<?php }
								if($row4['homephoneno']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Home Number:</p>
									</td>
									<td>
										<?php echo $row4['homephoneno']; ?>
										
									</td>
								</tr>
								<?php }
								if($row4['city']!=null || $row4['state']!=null){ ?>
								<tr>
									<td>
										<p class="eel">Address:</p>
									</td>
									<td>
										<?php echo $row4['housenumber'].", ".$row4['town']; ?><br />
										<?php echo $row4['city'].", ".$row4['state']; ?><br />
										<?php echo $row4['country']; ?>
									</td>
								</tr>
								<?php } ?>
							</table>
                       
                </li>
         	</ul>
			</div>
		</td>
		<td rowspan="2" width="200">
			<?php include('rightsides.php'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<ul style="list-style-type:none; margin:0px;">
		<?php
			$queryn="select * from tbl_updates where userid='".$_SESSION['id']."'";
			$r2=mysql_query($queryn);
			while($data=mysql_fetch_array($r2)){
		?>
			<li style="width:550px; padding:10px">
			<table>
				<tr>
					<td style="width:500px">
				<?php
					if($data['type']=='message'){
					?>
					<p style="font-family:Geneva; font-size:16px; margin:0px; padding:0px; width:500px; word-wrap:break-word">
					<?php
						echo $data['description']; 
					?>
					</p>
					<?php
					}
					else{
						echo $data['description'];
				?><br /><br />
				<img src="users/<?php echo $_SESSION['id']; ?>/statusimages/<?php echo $data['id']; ?>.jpg" style="height:100px; width:auto" />
				<?php
					}
				?>
					</td>
					<td>
						<a href="deletepost.php?postid=<?php echo $data['id']; ?>&a=2"><img src="images/delete1.png" /></a>
					</td>
				</tr>
			</table>
				<hr />
			</li>
		<?php
			}
		?>
			</ol>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
		</td>
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
