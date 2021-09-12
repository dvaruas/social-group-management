<?php
	session_start();
	include('include/db.php');
	$uid=$_GET['uid'];
	$sql="select * from tbl_friendlist where acceptorid='$uid'";
	$rs=mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title></title>
        <link rel="stylesheet" type="text/css" href="grid/reset.css" />
		<link rel="stylesheet" type="text/css" href="grid/gridNavigation.css" />
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="grid/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="grid/jquery.gridnav.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#tj_container').gridnav({
					rows : 1,
					type	: {
						mode		: 'sequpdown', 	// use def | fade | seqfade | updown | sequpdown | showhide | disperse | rows
						speed		: 400,			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows
						easing		: '',			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows	
						factor		: 50,			// for seqfade, sequpdown, rows
						reverse		: false			// for sequpdown
					}
				});
				
			});
		</script>
    </head>
    <body>
		<div class="container">
			<div class="content example5">
				<div id="tj_container" class="tj_container">
					<div class="tj_wrapper">
						<ul class="tj_gallery">
						<?php
							$temp=0;
							while($row=mysql_fetch_array($rs)){
								$sql1="select * from tbl_user where id='".$row['requesterid']."'";
								$rs1=mysql_query($sql1);
								$row1=mysql_fetch_array($rs1);
						?>
							<li>
								<a class="ballistic" href="" onclick="parent.closer('<?php echo $row1['id']; ?>');">
						
							<!-- image -->
									<?php
					$filename="users/".$row1['id']."/profilepics/thumbnail_pic.jpg";
					$filename1="users/".$row1['id']."/profilepics/resized_pic.jpg";
					if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data['gender']=='male')){
				?>
				<img class="mystyle" src="images/profile_pic.jpg" />	
				<?php
					}
					else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($data['gender']=='female')){
				?>
				<img class="mystyle" src="images/profile_pic_f.jpg" />	
				<?php
					}
					else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
				?>
				
				<img class="mystyle" src="users/<?php echo $row1['id']; ?>/profilepics/resized_pic.jpg" />
				
				
				<?php
					}
					else{
				?>
				
				<img class="mystyle" src="users/<?php echo $row1['id']; ?>/profilepics/thumbnail_pic.jpg" />
				
				<?php
					}
				?>
					<!-- end image code -->
								<div class="infos">
									<p style="font-family:Arial; font-size:14px"><?php echo $row1['name']; ?></p>
									<p style="font-family:Arial; font-size:10px"><?php echo $row1['location']; ?></p>
								</div>
								</a>
							</li>
						<?php
							$temp++;
							}
						?>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
		<?php if($temp==0){ ?>
			<p style="font-family:Verdana; font-size:18px">No users connected with this user....</p>
		<?php } ?>
		
    </body>
</html>