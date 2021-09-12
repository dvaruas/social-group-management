<?php 
	session_start();
	include('include/db.php');
	$f=0;
	if(isset($_POST['submit']) AND ($_POST['submit']=='Retrieve')){
		$securityans=$_POST['securityans'];
		if($securityans==$_SESSION['securityanswer']){
			$to=$_SESSION['emailid'];
			$from="Onlinebookstore@gmail.com";
			$msg=$_SESSION['password'];
			$subject="Change Password";
			$mail=mail($to,$from,$subject,$msg);
			session_destroy();
			if($mail){
				header('location:index.php');
			}
			else
				echo "Message can't send...";
		}
		else
			$f=1;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body background="images/background.jpg">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="620px">
	<tr>
		<td align="center" valign="middle">
			<form name="frmsecurityans" action="" method="post">
				<p style="font-family:Geneva; font-size:18px">Hello User</p>
			
				<p style="font-family:Verdana; font-size:16px">Answer your security question...</p>
				
				<p style="font-family:Verdana; font-size:12px">Q: <?php echo $_SESSION['securityques']; ?></p>
				
				<p style="font-family:Verdana; font-size:12px">A: <input type="text" name="securityans" /></p>
			
				<input type="submit" name="submit" value="Retrieve" /><br />
				<?php
					if($f==1)
						echo "You Have Enterted Wrong Answer....";
				?>
			</form>
		</td>
	</tr>
</table>

</body>
</html>
