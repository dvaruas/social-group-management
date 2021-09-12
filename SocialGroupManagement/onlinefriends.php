<?php 
	$sql1="select * from tbl_friendlist where requesterid='".$_SESSION['id']."'";
	$rs1=mysql_query($sql1);
	/*while($row=mysql_fetch_array($rs)){
		$sql1="select * from tbl_friendlist where acceptorid='".$row['acceptorid']."'";
		$rs1=mysql_query($sql1);
	}*/
	/*$sql2="select * from tbl_friendlist where acceptorid='".$_SESSION['id']."'";
	$rs2=mysql_query($sql2);*/
	$flag=0;
	
	/*echo $sql5="SELECT * FROM tbl_chat WHERE (DAY( posted ) = DAY( CURDATE( ) ) AND MONTH( posted ) = MONTH( CURDATE( ) ) AND YEAR( posted ) = YEAR( CURDATE( ) ))AND (receiverid =  '".$_SESSION['id']."') AND (status=1) ORDER BY posted DESC LIMIT 0 , 30";
	$rs5=mysql_query($sql5);
	while($row5=mysql_fetch_array($rs5)){
		
		
		
		if(($row5['status']==1)){
			echo $flag=1;
			break;
		}
		else{
			$flag=2;
		}
		
	}*/
?>
<style>
.on
{	opacity:0.7;
}
.on:hover
{	opacity:1.0;
}
</style>
<script type="text/javascript">
	function f(id){
		window.open( "updatechatstatus.php?id="+id );
	}
	
</script>
<script type="text/javascript">
	//process = setInterval("window.location.reload( true )", 1000);
</script>
<b>ONLINE FRIENDS</b>
<table border="0" cellpadding="5" cellspacing="1">
	<?php
		while($row1=mysql_fetch_array($rs1)){
			$sql6="select * from tbl_chatrequest where receiverid='".$_SESSION['id']."' and userid='".$row1['acceptorid']."'";
			$rs6=mysql_query($sql6);
			while($row6=mysql_fetch_array($rs6)){
				if($row6['status']==1){
					$_SESSION['flag']=1;
			//$flag=1;
			$sql7="update tbl_chatrequest set status='0' where id='".$row6['id']."'";
			mysql_query($sql7);
			break;
			}
		}
			$sqln="select * from tbl_friendlist where acceptorid='".$row1['requesterid']."' and requesterid='".$row1['acceptorid']."'";
			$rsn=mysql_query($sqln);
			if(mysql_num_rows($rsn)>0){
			$sql3="select * from tbl_user where id='".$row1['acceptorid']."' and loginstatus='1'";
			$rs3=mysql_query($sql3);
			while($row3=mysql_fetch_array($rs3)){
	?>
	<tr>
		<td>
			<a href="" onClick="return f('<?php echo $row3['id']; ?>');"><img class="on" src="images/online.png">
			</a>
		</td>
		<td>
		<?php
			$filename="users/".$row3['id']."/profilepics/thumbnail_pic.jpg";
			$filename1="users/".$row3['id']."/profilepics/resized_pic.jpg";
			if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($_SESSION['gender']=='male')){
		?>
		<img src="images/profile_pic.jpg" width="40" height="40"  />
		<?php
			}
			else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($_SESSION['gender']=='female')){
		?>
		<img src="images/profile_pic_f.jpg" width="40" height="40"  />
		<?php
			}
			else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
		?>
		
		<img src="users/<?php echo $row3['id']; ?>/profilepics/resized_pic.jpg" width="40" height="40"  />
		
		
		<?php
			}
			else{
		?>
		
		<img src="users/<?php echo $row3['id']; ?>/profilepics/thumbnail_pic.jpg" width="40" height="40"  />
		
		<?php
			}
		?>
		</td>
		<td style="font-family:Arial; font-size:14px">
		<?php 
			echo $row3['name']; 
			//echo $flag;
			if(isset($_SESSION['flag']) && ($_SESSION['flag']==1)){
				echo "(1 new chat)";
			}
		?>
		</td>
	</tr>
	<?php
			}
			}
		}
	?>
	<?php /*?><?php
		while($row2=mysql_fetch_array($rs2)){
			$sql4="select * from tbl_user where id='".$row2['requesterid']."' and loginstatus='1'";
			$rs4=mysql_query($sql4);
			while($row4=mysql_fetch_array($rs4)){
	?>
	<tr>
		<td>
		<?php
			$filename="users/".$row4['id']."/profilepics/thumbnail_pic.jpg";
			$filename1="users/".$row4['id']."/profilepics/resized_pic.jpg";
			if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($_SESSION['gender']=='male')){
		?>
		<a href="" onClick="return f('<?php echo $row4['id']; ?>');"><img src="images/profile_pic.jpg" width="40" height="40"  />	</a>
		<?php
			}
			else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($_SESSION['gender']=='female')){
		?>
		<a href="" onClick="return f('<?php echo $row4['id']; ?>');"><img src="images/profile_pic_f.jpg" width="40" height="40"  />	</a>
		<?php
			}
			else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
		?>
		
		<a href="" onClick="return f('<?php echo $row4['id']; ?>');"><img src="users/<?php echo $row4['id']; ?>/profilepics/resized_pic.jpg" width="40" height="40"  /></a>
		
		
		<?php
			}
			else{
		?>
		
		<a href="" onClick="return f('<?php echo $row4['id']; ?>');"><img src="users/<?php echo $row4['id']; ?>/profilepics/thumbnail_pic.jpg" width="40" height="40"  /></a>
		
		<?php
			}
		?>
		</td>
		<td style="font-size:9px">
		<?php 
			echo $row4['name']; 
			if($flag==2){
				echo "(1 new chat)";
			}
		?>
		</td>
	</tr>
	<?php
			}
		}
	?><?php */?>
</table>