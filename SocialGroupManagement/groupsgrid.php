<?php
	session_start();
	include('include/db.php');
	$uid=$_GET['uid'];
	$sql="select * from tbl_grouplist where userid='".$uid."'";
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
								$sql1="select * from tbl_group where id='".$row['groupid']."'";
								$rs1=mysql_query($sql1);
								$row1=mysql_fetch_array($rs1);
						?>
							<li>
								<a class="ballistic" href="group.php?a=0&gid=<?php echo $row1['id']; ?>" onClick="parent.closer('<?php echo $row1['id']; ?>')">
									<?php
										$grpname="groups/".$row1['id']."/profilepics/".$row1['id'].".jpg";
										if(!file_exists ( $grpname )){
									?>
									<img class="mystyle" src="images/default-group-image.gif" style="height:100px; width:100px;" />
									<?php 
										}
										else{
									?>
									<img class="mystyle" src="groups/<?php echo $row1['id']; ?>/profilepics/<?php echo $row1['id']; ?>.jpg" style="height:100px; width:100px;" />
									<?php
										}
									?>
									<p class="infos">
										<?php echo $row1['name']; ?><br />
										Members: <?php echo $row1['noofmembers']; ?><br />
									</p>
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
			<p style="font-family:Verdana; font-size:18px">Not connected with any group.....</p>
		<?php } ?>
    </body>
</html>