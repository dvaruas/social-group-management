<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$flag=0;
	if(isset($_GET['id'])){
		$uid=$_GET['id'];
		$flag=1;
	}
	if(isset($_POST['submit']) AND ($_POST['submit']=='share')){
		$userid=$_SESSION['id'];
		$time_offset ="525"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$time = date("h:i:s",time() + $time_a);
		$date=date('Y-m-d');
		$imagename=$_FILES['uploadedfile']['name'];
		$status=1;
		$sql="insert into tbl_gallery(userid,time,date,imagename,status) values('$userid','$time','$date','$imagename','$status')";
		mysql_query($sql);
		
		//UPLOAD IMAGE CODE STARTS
		
		$query="select MAX(id) as max from tbl_gallery";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$id=$row['max'];
		$uploaddir = 'users/'.$userid.'/gallery/';
		//$_FILES['uploadedfile']['name']=$id.".jpg";
		$uploadfile = $uploaddir . basename($_FILES['uploadedfile']['name']);
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadfile);
		header('refresh:1');
		//UPLOAD IMAGE CODE ENDS
	}
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Gallery</title>
		<link rel="stylesheet" href="gallery_f/basic.css" type="text/css" />
		<link rel="stylesheet" href="gallery_f/galleriffic.css" type="text/css" />
		<!--<script type="text/javascript" src="gallery_f/jquery-1.3.2.js"></script>-->
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="gallery_f/jquery.galleriffic.js"></script>
		<script type="text/javascript" src="gallery_f/jquery.opacityrollover.js"></script>
		<script type="text/javascript" src="jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox-1.3.4.css" media="screen" />
		<script type="text/javascript">
		</script>
		
	</head>
	<body>
	<?php 
		if($flag==0){
	?>
	<p class="seler" style="cursor:pointer; text-align:center; font-size:11px">Upload a picture</p>
	<?php
		}
	?>

	<div class="selera" style="display:none;">
		<form name="formgal" method="post" action="" enctype="multipart/form-data">
		<input type="file" name="uploadedfile" id="file" style="background-color:transparent; border:#000000 groove;">
		<input type="submit" name="submit" value="share" style="font-size:12px;"/>
	</form>
	</div>
	<?php 
		if($flag==0){
	?>
	<a href="homes.php" style="padding:10">Exit Gallery</a></p>
	<?php
		}
		else{
	?>
	<a href="oprofile.php?id=<?php echo $uid; ?>" style="padding:10">Exit Gallery</a></p>
	<?php
		}
	?>
	
		<div id="page">
			<div id="container">
				<!-- Start Advanced Gallery Html Containers -->
				<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container"></div>
				</div>
				<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">
					<!--FOR GALLERY IMAGES CODE STARTS-->
					<?php
						if($flag==0){
							$sql2="select * from tbl_gallery where userid='".$_SESSION['id']."'";
						}
						else{
							$sql2="select * from tbl_gallery where userid='".$uid."'";
						}
						$rs2=mysql_query($sql2);
						while($row2=mysql_fetch_array($rs2)){
					?>	
					 <li>
					 <?php
					 	if($flag==0){
					 ?>
					 <a class="thumb" href="users/<?php echo $_SESSION['id']; ?>/gallery/<?php echo $row2['imagename']; ?>" >
				<img class="thumbsiz" src="users/<?php echo $_SESSION['id']; ?>/gallery/<?php echo $row2['imagename']; ?>" alt="" />							
								</a>
					 <?php
					 	}
						else{
					 ?>
					 <a class="thumb" href="users/<?php echo $uid; ?>/gallery/<?php echo $row2['imagename']; ?>" >
				<img class="thumbsiz" src="users/<?php echo $uid; ?>/gallery/<?php echo $row2['imagename']; ?>" alt="" />							
								</a>
					 <?php 
					 	}
					 ?>
					
							<div class="caption">
								<div class="download">
								<?php
									if($flag==0){
								?>
								<a class="example" href="users/<?php echo $_SESSION['id']; ?>/gallery/<?php echo $row2['imagename']; ?>">View original size</a><br>
								<a href="removeimage.php?remove_file=<?php echo $row2['imagename']; ?>&source=gallery&file_id=<?php echo $row2['id']; ?>">Remove Image</a><br>
								<a href="download.php?download_file=<?php echo $row2['imagename']; ?>&source=gallery">Download Original</a>
								<?php
									}
									else{
								?>
								<a class="example" href="users/<?php echo $uid; ?>/gallery/<?php echo $row2['imagename']; ?>">View original size</a><br>
								<a href="download.php?download_file=<?php echo $row2['imagename']; ?>&source=gallery&uuid=<?php echo $row2['userid']; ?>">Download Original</a>
								<?php 
									}
								?>
										
								</div>
								<div class="image-title">picture name</div>
								<div class="image-desc">Description</div>
								<?php
									if($flag==0){
								?>
								<a class="iframe" href="test.php?id=<?php echo $row2['id']; ?>&source=gallery">comments</a>
								<?php
									}
									else{
								?>
								<a class="iframe" href="test.php?id=<?php echo $row2['id']; ?>&source=gallery&ouid=1">comments</a>
								<?php 
									}
								?>

								
							</div>
						</li>
						<?php
						}
					?>
					<!--FOR GALLERY IMAGES CODE ENDS-->
					<!--FOR STATUS IMAGES CODE STARTS-->	
					<?php
						if($flag==0){
							$sql1="select * from tbl_updates where userid='".$_SESSION['id']."' and type='photo'";
						}
						else{
							$sql1="select * from tbl_updates where userid='".$uid."' and type='photo'";
						}
						$rs1=mysql_query($sql1);
						while($row1=mysql_fetch_array($rs1)){
					?>	
					 <li>
					<?php
						if($flag==0){
					?>
					<a class="thumb" href="users/<?php echo $_SESSION['id']; ?>/statusimages/<?php echo $row1['id']; ?>.jpg" >
				<img class="thumbsiz" src="users/<?php echo $_SESSION['id']; ?>/statusimages/<?php echo $row1['id']; ?>.jpg" alt="" />							
								</a>
					<?php
						}
						else{
					?>
					<a class="thumb" href="users/<?php echo $uid; ?>/statusimages/<?php echo $row1['id']; ?>.jpg" >
				<img class="thumbsiz" src="users/<?php echo $uid; ?>/statusimages/<?php echo $row1['id']; ?>.jpg" alt="" />							
								</a>
					<?php 
						}
					?>

					
							<div class="caption">
								<div class="download">
								<?php
									if($flag==0){
								?>
								<a class="example" href="users/<?php echo $_SESSION['id']; ?>/statusimages/<?php echo $row1['id']; ?>.jpg">View original size</a><br>
								<a href="removeimage.php?remove_file=<?php echo $row1['id']; ?>.jpg&source=status&file_id=<?php echo $row1['id']; ?>">Remove Image</a><br>
								<a href="download.php?download_file=<?php echo $row1['id']; ?>.jpg&source=status">Download Original</a>
								<?php
									}
									else{
								?>
								<a class="example" href="users/<?php echo $uid; ?>/statusimages/<?php echo $row1['id']; ?>.jpg">View original size</a><br>
								<a href="download.php?download_file=<?php echo $row1['id']; ?>.jpg&source=status&uuid=<?php echo $uid; ?>">Download Original</a>
								<?php 
									}
								?>
										
								</div>
								<div class="image-title">picture name</div>
								<div class="image-desc">Description</div>
								<a class="iframe" href="test.php?id=<?php echo $row1['id']; ?>&source=status&ouid=1">comments</a>
							</div>
						</li>
						<?php
						}
					?>
					<!--FOR STATUS IMAGES CODE ENDS-->	
					</ul>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		<script type="text/javascript">
            jQuery(document).ready(function($) {
                
                 $('.seler').click(function(){
                            $(this).next('.selera').slideToggle("slow");
                        });
                // We only want these styles applied when javascript is enabled
                $('div.navigation').css({'width' : '300px', 'float' : 'left'});
                $('div.content').css('display', 'block');

                // Initially set opacity on thumbs and add
                // additional styling for hover effect on thumbs
                var onMouseOutOpacity = 0.67;
                $('#thumbs ul.thumbs li').opacityrollover({
                    mouseOutOpacity:   onMouseOutOpacity,
                    mouseOverOpacity:  1.0,
                    fadeSpeed:         'fast',
                    exemptionSelector: '.selected'
                });
                
                // Initialize Advanced Galleriffic Gallery
                var gallery = $('#thumbs').galleriffic({
                    delay:                     2500,
                    numThumbs:                 15,
                    preloadAhead:              10,
                    enableTopPager:            false,
                    enableBottomPager:         true,
                    maxPagesToShow:            7,
                    imageContainerSel:         '#slideshow',
                    controlsContainerSel:      '#controls',
                    captionContainerSel:       '#caption',
                    loadingContainerSel:       '#loading',
                    renderSSControls:          true,
                    renderNavControls:         true,
                    playLinkText:              'Play Slideshow',
                    pauseLinkText:             'Pause Slideshow',
                    prevLinkText:              '&lsaquo; Previous Photo',
                    nextLinkText:              'Next Photo &rsaquo;',
                    nextPageLinkText:          'Next &rsaquo;',
                    prevPageLinkText:          '&lsaquo; Prev',
                    enableHistory:             false,
                    autoStart:                 false,
                    syncTransitions:           true,
                    defaultTransitionDuration: 900,
                    onSlideChange:             function(prevIndex, nextIndex) {
                        // 'this' refers to the gallery, which is an extension of $('#thumbs')
                        this.find('ul.thumbs').children()
                            .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                            .eq(nextIndex).fadeTo('fast', 1.0);
                    },
                    onPageTransitionOut:       function(callback) {
                        this.fadeTo('fast', 0.0, callback);
                    },
                    onTransitionIn: function() {
                            $('#slideshow').fadeTo('fast', 1.0);
                            $('#slideshow span.image-wrapper').fadeTo('fast', 1.0);
                            $('#caption').fadeTo('fast', 1.0);
                            $('#caption span.image-caption').fadeTo('fast', 1.0); 
                     $("a.example").fancybox({
                        'overlayShow'    : true,
                        'transitionIn'    : 'elastic',
                        'transitionOut'    : 'elastic'
                        });
	
					$(".iframe").fancybox({
						'overlayShow'    : true,
                        'transitionIn'    : 'elastic',
                        'transitionOut'    : 'elastic'
						});
                     
                    		},
                    
                    onPageTransitionIn:        function() {
                        this.fadeTo('fast', 1.0);
                    }
                    });
            });
            
            
        </script>
	</body>
</html>