<?php
	
?>
<link rel="stylesheet" href="upperhead_style.css" type="text/css" media="screen"/>
<link href="style.css" rel="stylesheet" type="text/css" />
 <!-- The JavaScript -->
 		
        <script type="text/javascript" src="upperhead.js"></script>
		<script type="text/javascript" src="interface.js"></script>
		<script type="text/javascript" src="jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox-1.3.4.css" media="screen" />
	
		<script type="text/javascript">
	
		$(document).ready(function(){
			
			 $("#iframe").fancybox({});
				$("#bull1").hide();
				$("#bull2").click(function(){
					 $("#bull1").show();

					});
			$('#dock2').Fisheye(
				{
					maxWidth: 60,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 40,
					proximity: 80,
					alignment : 'left',
					valign : 'left' ,
					halign : 'left'
				});
			
			$("#bull2").click(function(){
				$("#bull1").fadeIn("slow");
				});
		});
		function closeIFrame(){
    		 $('#bull1').fadeOut("slow",function(){location.reload(true);
			 });
}
	


		</script>
		

		<iframe id="bull1" src="uploadimage.php" width="600" height="610" style="position:absolute; top:5%; left:20%; z-index:100; background-image:url(images/imguploadback.png)" marginheight="0" frameborder="0"></iframe>
	 <table width=100% border="0">
                <tr>
				<td width="200"><center>
				<div class="faux" style="position:relative">
				<p id="bull2" style="left:15%; top:30%">Change Picture</p>
				<a href="editprofile.php" style="text-decoration:none"><p style="left:20%; top:50%">Edit profile</p></a>
				<?php
					$filename="users/".$_SESSION['id']."/profilepics/thumbnail_pic.jpg";
					$filename1="users/".$_SESSION['id']."/profilepics/resized_pic.jpg";
					if(!file_exists ( $filename ) && !file_exists ( $filename1 )){
				?>
				<img src="images/profile_pic.jpg" width="135" height="132"  />	
				<?php
					}
					else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
				?>
				
				<img src="users/<?php echo $_SESSION['id']; ?>/profilepics/resized_pic.jpg" width="135" height="132"  />
				
				
				<?php
					}
					else{
				?>
				
				<img src="users/<?php echo $_SESSION['id']; ?>/profilepics/thumbnail_pic.jpg" width="135" height="132"  />
				
				</div>
				<?php
					}
				?>
				</center></td>
                  <td>
				  <div class="content">
			<ul id="sdt_menu" class="sdt_menu">
			 
				<li>
					<a href="homes.php">
					<img src="images/1.jpg" alt=""/>
					<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Home</span>							</span>						</a>				</li>
				<li>
					<a href="#">
						<img src="images/2.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Profile</span>						</span>					</a>				</li>
				<li>
					<a href="groups.php"><img src="images/3.jpg" alt=""/>
					<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Groups</span>						</span>					</a>				</li>
				<li>
					<a href="connections.php">
						<img src="images/4.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Connections</span>						</span>					</a>				</li>
			</ul>
	</div>	</td>
                  
                  <td>
				 
				  
	<div class="loginboxdiv">
	<form name="search" action="" method="post">
	<input type="submit" value="" height="23" width="23" style="position: relative; top:9px; left: 12%; z-index: 10; opacity:0; cursor:pointer"/>
<input class="loginbox" type="text" name="search" value=""/>  
</form>
 
</div>  <br /><br />
<div class="wrapper">
		<div class="dock" id="dock2">
  <div class="dock-container2">
  <a class="dock-item2" href="gallery.php"><img src="images/gallery.png" alt="Gallery" /><span>Gallery</span></a> 
  <a class="dock-item2" href="messages.php"><img src="images/messages.png" alt="Messages" /><span>Messages</span></a> 
  <a id="iframe" class="dock-item2" href="settings.php"><img src="images/settings.png" alt="Settings" /><span>Settings</span></a> 
  <a class="dock-item2" href="logout.php"><img src="images/logoff.png" alt="Logoff" /><span>Logoff</span></a> 
   </div>
</div>
    
    </div>
</td>
				  				 
                </tr>
    </table>
		

       