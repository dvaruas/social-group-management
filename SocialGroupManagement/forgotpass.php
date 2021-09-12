<?php
	session_start();
	include('include/db.php');
	$flag=0;
	if(isset($_POST['submit']) AND ($_POST['submit']=='Go')){
		$emailid=$_POST['emailid'];
		$sql="select * from tbl_user where emailid='$emailid'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)<>0){
			$row=mysql_fetch_array($rs);
			$_SESSION['emailid']=$row['emailid'];
			$_SESSION['securityques']=$row['securityquestion'];
			$_SESSION['securityanswer']=$row['securityanswer'];
			$_SESSION['password']=$row['password'];
			header('location:securityans.php');
		}
		else{
			$flag=1;
		}
	}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="620px">
	<tr>
		<td align="center">
			<form name="forgot" action="" method="post">
				<?php 
					if($flag==1)
						echo "Invalid email address...";
				?>
				<p style="font-family:Verdana; font-size:12px">Enter your email address : <input name="emailid" type="text"  />
				<input type="submit" name="submit" value="Go" /></p>
			</form>
		</td>
	</tr>
</table>

