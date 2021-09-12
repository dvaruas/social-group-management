<?php
	session_start();
	include('include/db.php');
	include('include/function.php');
	secure();
	$flag=0;
	$sql1="select * from tbl_user where id='".$_SESSION['id']."'";
	$result=mysql_query($sql1);
	$data=mysql_fetch_array($result);
	if(isset($_POST['button1']) AND ($_POST['button1']=='update')){
		$username=$_POST['username'];
		$sql="update tbl_user set name='$username' where id='".$_SESSION['id']."'";
		mysql_query($sql);
		header('location:settings.php');
	}
	if(isset($_POST['button2']) && ($_POST['button2']=='update')){
		$oldpassword=$_POST['oldpassword'];
		$newpassword=$_POST['newpassword'];
		$query="select * from tbl_user where id='".$_SESSION['id']."'";
		$rs=mysql_query($query);
		$row=mysql_fetch_array($rs);
		if($oldpassword==$row['password']){
			$sql="update tbl_user set password='$newpassword' where id='".$_SESSION['id']."'";
			mysql_query($sql);
		}
		else{
			$flag=1;
		}
		header('location:settings.php');
	}
	if(isset($_POST['button3']) && ($_POST['button3']=='update')){
		$primarymail=$_POST['primarymail'];
		$secondarymail=$_POST['secondarymail'];
		$query="select * from tbl_user where emailid='$primarymail'";
		$result=mysql_query($query);
		if((mysql_num_rows($result)<>0) AND ($data['emailid']!=$primarymail)){
			echo "EmailID already exists.....";
		}
		else{
			$sql="update tbl_user set emailid='$primarymail',secemailid='$secondarymail' where id='".$_SESSION['id']."'";
			mysql_query($sql);
			header('location:settings.php');		
		}
		
	}
	if(isset($_POST['button4']) && ($_POST['button4']=='update')){
		$location=$_POST['location'];
		$sql="update tbl_user set location='$location' where id='".$_SESSION['id']."'";
		mysql_query($sql);
		header('location:settings.php');
	}
	if(isset($_POST['button5']) && ($_POST['button5']=='update')){
		$securityques=$_POST['securityques'];
		$securityans=$_POST['securityans'];
		$sql="update tbl_user set securityquestion='$securityques',securityanswer='$securityans' where id='".$_SESSION['id']."'";
		mysql_query($sql);
		header('location:settings.php');
	}
	if(isset($_POST['button6']) && ($_POST['button6']=='yes')){
		$s1="select * from tbl_updates where userid='".$_SESSION['id']."'";
		$r1=mysql_query($s1);
		while($rw1=mysql_fetch_array($r1)){
			if($rw1['type']=='photo'){
				$file="users/".$_SESSION['id']."/statusimages/".$rw1['id'].".jpg";
				unlink($file);
			}
		}
		$s2="select * from tbl_gallery where userid='".$_SESSION['id']."'";
		$r2=mysql_query($s2);
		while($rw2=mysql_fetch_array($r2)){
				$file1="users/".$_SESSION['id']."/gallery/".$rw2['imagename'];
				unlink($file1);
		}
		$filenm="users/".$_SESSION['id']."/profilepics/thumbnail_pic.jpg";
		if(file_exists ( $filenm )){
			unlink($filenm);
		}
		$filenm1="users/".$_SESSION['id']."/profilepics/resized_pic.jpg";
		if(file_exists ( $filenm1 )){
			unlink($filenm1);
		}
		$sql="delete from tbl_user where id='".$_SESSION['id']."'";
		mysql_query($sql);
		$fullpath1="users/".$_SESSION['id']."/profilepics/";
		$fullpath2="users/".$_SESSION['id']."/gallery/";
		$fullpath3="users/".$_SESSION['id']."/statusimages/";
		$fullpath4="users/".$_SESSION['id']."/";
		rmdir($fullpath1);
		rmdir($fullpath2);
		rmdir($fullpath3);
		rmdir($fullpath4);
		session_destroy();
	}
?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	
$(document).ready(function(){

		$("div.blockso").hide();
		 $("#xx").show();
		$("li.fanta").click(function(){
 	  $("div.blockso").hide();
 	  var $tmp=$(this).attr("rel");              
	 $("#"+$tmp).fadeIn("slow");
	 $("#asterix").click(function(){parent.$.fancybox.close();
			});
 	
});

	
});
</script>
<script type="text/javascript">
	function f1(){
		if(document.fms.oldpassword.value!=document.fms.oldpass.value){
			alert('Please enter old password correctly...');
			document.fms.oldpassword.focus();
			return false;
		}
		if(document.fms.newpassword.value!=document.fms.repassword.value){
			alert('Password and retype password are not same..');
			document.fms.repassword.focus();
			return false;
		}
		
	}
	
	function f2(){
		
		//email id
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var adnew = document.fmmail.primarymail.value;
		
		if(reg.test(adnew) == false){
			alert('!!!Invalid Email Address!!!');
			document.fmmail.primarymail.focus();
			return false;
		}
	}
	function f3(){
		if(document.fmqans.securityques.value==''){
			alert('Security question cannot remain blank...');
			document.fmqans.securityques.focus();
			return false;
		}
		
		if(document.fmqans.securityans.value==''){
			alert('Security answer cannot remain blank...');
			document.fmqans.securityans.focus();
			return false;
		}
	}
</script>
<style>
body
{
	background-image:url(images/setiingback.jpg);
	font-family: Kokila;
	font-size:18px;
	padding:10px;
}*
.fanta
{
	font-family: DaunPenh;
	font-size:20px;
	cursor: pointer;
}
.fanta:hover
{
	text-decoration:underline;
}
</style>

	<table border="0">
		<tr>
			<td colspan="2">
				<p style="font-family: Andalus; font-size:20px; font-weight:bold; padding-left:40px">Account Settings</p>
			</td>
		</tr>
		<tr>
			<td style="width:200px">
		<ul style="list-style:none;">
			<li rel="a" class="fanta">
			Change user name
			</li>
			<li rel="b" class="fanta">
			Change password
			</li>
			<li rel="c" class="fanta">
			Change email address
			</li>
			<li rel="d" class="fanta">
			Change location
			</li>
			<li rel="e" class="fanta">
			Change security question
			</li>
			<li rel="f" class="fanta">
			Delete account
			</li>
		</ul>
			</td>
			<td style="width:300px; height:240px">
				<div id="xx" class="blockso">
					<table style="text-align:center">
						<tr>
							<td>
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
						<?php
							}
						?>
							</td>
						</tr>
						<tr>
							<td>
								<a href="uploadimage.php" style="color:#000000">Change DP</a>
							</td>
						</tr>
						<tr>
							<td>
								<a href="editprofile.php" style="color:#000000">Edit Profile</a>
							</td>
						</tr>
					</table>
				</div>
					<form name="fmu" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
					<div id="a" class="blockso">
					
						<table>
							<tr>
								<td>
									Enter new User name:
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="username" value="<?php echo $data['name']; ?>" />
								</td>
							</tr>
							<tr>
								<td>
									<input type="submit" name="button1" value="update" />
								</td>
							</tr>
						</table>
					
					</div>
					</form>
					<form name="fms" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return f1();">
					<div id="b" class="blockso">
						<table>
							<tr>
								<input type="hidden" name="oldpass"  value="<?php echo $data['password']; ?>"/>
								<td>Enter old password:</td>
								<td><input type="password" name="oldpassword" /></td>
							</tr>
							<tr>
								<td>Enter new password:</td>
								<td><input type="password" name="newpassword" /></td>
							</tr>
							<tr>
								<td>Retype password:</td>
								<td><input type="password" name="repassword" /></td>
							</tr>
							<tr>
								<td colspan='2'><input type="submit" name="button2" value="update" /></td>
							</tr>
						</table>
					</div>
					</form>
					<form name="fmmail" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return f2();">
					<div id="c" class="blockso">
						<table>
							<tr>
								<td>Primary email address:</td><td><input type="text" name="primarymail" value="<?php echo $data['emailid']; ?>" /></td>
							</tr>
							<tr>
								<td>Secondary email address:</td><td><input type="text" name="secondarymail" value="<?php echo $data['secemailid']; ?>" /></td>
							</tr>
							<tr>
								<td colspan='2'><input type="submit" name="button3" value="update" /></td>
							</tr>
						</table>
					</div>
					</form>
					<form name="fml" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
					<div id="d" class="blockso">
						<table>
							<tr>
								<td>Update your Location:</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="location" value="<?php echo $data['location']; ?>" />
								</td>
							</tr>
							<tr>
								<td>
									<input type="submit" name="button4" value="update" />
								</td>
							</tr>
						</table>
					</div>
					</form>
					<form name="fmqans" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"  onsubmit="return f3();">
					<div id="e" class="blockso">
						<table>
							<tr>
								<td>Enter security question:</td><td><input type="text" name="securityques" value="<?php echo $data['securityquestion']; ?>" /></td>
							</tr>
							<tr>
								<td>Enter answer:</td><td><input type="text" name="securityans" value="<?php echo $data['securityanswer']; ?>" /></td>
							</tr>
							<tr>
								<td colspan='2'><input type="submit" name="button5" value="update" /></td>
							</tr>
						</table>
					</div>
					</form>
					<form name="fmd" action="" method="post" >
					<div id="f" class="blockso">
						<table>
							<tr>
								<td>Are you sure you want to delete your account?</td>
							</tr>
							<tr>
								<td><input id="asterix" type="submit" name="button6" value="yes"  /></td>
							</tr>
						</table>
					</div>
					</form>
			</td>
		</tr>
	</table>