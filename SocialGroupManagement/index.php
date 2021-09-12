<?php
	session_start();
	if(isset($_SESSION['id'])){
		header('location:homes.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome</title>
<script type="text/javascript" src="jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="jquery.js" ></script>
<script language="javascript">
function check(e,bui)
{	if(bui=="User Id")
		e.value="";
	else if(bui=="")
		e.value="User Id";
}
function change(e,s)
{if(s==1)
	e.src="images/iPhone-like-button copy2.jpg";
if(s==2)
	e.src="images/iPhone-like-button copy.jpg";
}
</script> 
<script type="text/javascript">
function submitform()
{
  document.aa.submit();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("img.start").hover(
		function() {
			$(this).stop().animate({"opacity": "0"},  "slow");},
		function() {
			$(this).stop().animate({"opacity": "1"},  "slow");
		});

	$("#alien").fancybox({});

});
</script>
<link href="wrapper.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
		if(isset($_GET['a']) && ($_GET['a']==1)){ ?>
			<p style="font-family:Verdana; font-size:14px; position:absolute; top:30%; left:40%">
				<img src="images/invalid.png" />
			</p>			
	<?php
		}
	?>
<form name="aa" action="logincode.php" method="post">
<div id="userlog">
	<div class="loginboxdiv">
	
<input class="loginbox" type="text" onclick="check(this,value)" onblur="check(this,value)" name="userid" value="<?php if(isset($_COOKIE['cookname'])){ 
																														echo $_COOKIE['cookname'];
																														} 
																														else
																														echo "User Id";
																												?>"/>  
</div> </div>
<div id="passlog">
	<div class="loginboxdiv">
<input class="loginbox" type="password" onclick="check(this,value)" onblur="check(this,value)" name="password" value="<?php if(isset($_COOKIE['cookpass'])){ 
																														echo $_COOKIE['cookpass'];
																														} 
																														else
																														echo "User Id";
																												?>"/>
	</div> 
</div>
<div id="image">
<a href="javascript: submitform()" title="Login">
<img src="images/submit1.jpg" class="start" width="90" height="34" style="border-style: none" />
<img src="images/submit2.jpg" class="end" width="90" height="34" style="border-style: none" />
</a>
</div>
<div id="remember">
<input type="checkbox" value="1" name="remember" />
<p style="position:relative; left: 20px; top: -33px; font-size:14px; width: 30px"><b>Remember Me</b></p>
</div>
</form>
<a id="alien" href="forgotpass.php" style="text-decoration:none">Forgot password?</a>
<a href="register.php"  class="profiledetails" rel="gallery">
<img src="images/register1.png" class="start" style="position:absolute; left: 76%; top: 12%; border-style: none" />
<img src="images/register2.png" class="end" style="position:absolute; left: 76%; top: 12%; border-style: none" />
</a>
<!--<a href="guestlogin.php">
<img src="images/gstlogin1.png" class="start" style="position:absolute; left: 76%; top: 20%; border-style: none" />
<img src="images/gstlogin2.png" class="end" style="position:absolute; left: 76%; top: 20%; border-style: none" />
</a>-->
</body>
</html>
