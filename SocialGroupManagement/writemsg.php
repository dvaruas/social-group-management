<?php
	session_start();
	include('include/db.php');
	$threadid=$_GET['tid'];
	$sqlad="select * from tbl_thread where id='$threadid'";
	$rsad=mysql_query($sqlad);
	$rowad=mysql_fetch_array($rsad);
	$noofmessages=$rowad['noofmessages'];
	if(isset($_POST['submit']) AND ($_POST['submit']=='post')){
		$msgbody=$_POST['msgbody'];
		$time_offset ="165"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$time = date("H:i:s ",time() + $time_a);
		$date=date('Y-m-d');
		$receiverstatus=1;
		$senderstatus=1;
		$readstatus=0;
		$status=1;
		$senderid=$_SESSION['id'];
		if($rowad['initiatorid']==$_SESSION['id']){
			$receiverid=$rowad['receiverid'];
		}
		else{
			$receiverid=$rowad['initiatorid'];
		}
		$sql1="insert into tbl_messages(threadid,messagedate,messagetime,receiverid,senderid,body,receiverstatus,senderstatus,readstatus,status) values('$threadid','$date','$time','$receiverid','$senderid','$msgbody','$receiverstatus','$senderstatus','$readstatus','$status')";
		mysql_query($sql1);
		
		$noofmessages+=1;
		$date=date('Y-m-d');
		$sql2d="update tbl_thread set noofmessages='$noofmessages',lastmessagedate='$date' where id='$threadid'";
		mysql_query($sql2d);
	}
?>


<form name="frmwrtmsg" action="" method="post">
	<table>
		<tr>
			<td>
				<p style="border:0; margin:0; text-align:center; font-family:Andalus; font-size:14px;">Write your message</p>
			</td>
		</tr>
		<tr>
			<td>
				<textarea name="msgbody" rows="10" cols="40" style="font-family:Verdana; font-size:12px"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<center><input type="submit" name="submit" value="post" align="middle" onclick="parent.$.fancybox.close();" />
				</center>
			</td>
		</tr>
	</table>
</form>
