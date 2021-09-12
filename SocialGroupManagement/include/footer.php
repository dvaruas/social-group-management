<?php

	$ids=$_SESSION['id'];
	$note=array("","","","","","","","","","");
	$noteid=array(0,0,0,0,0,0,0,0,0,0);
	
	$sqlf1="select * from tbl_notes where userid='$ids' order by noteid desc";
	$resultf1=mysql_query($sqlf1);
	$i=0;
	while($dataf1=mysql_fetch_array($resultf1))
	{	$note[$i]=$dataf1['note'];
		$noteid[$i]=$dataf1['noteid'];
		$i++;
	}
	
	if(isset($_POST['saver']) AND $_POST['saver']!=0){
		$note=$_POST['note'];
		$userid=$_SESSION['id'];
		$status=1;
		$j=0;
		while($j<10){
			if($noteid[$j]==$_POST['saver'])
			{	$sqlf3="update tbl_notes set note='$note' where noteid='".$_POST['saver']."' AND userid='$ids'";
				break;
			}
			if($noteid[$j]==0){
				$sqlf3="insert into tbl_notes values('".$_POST['saver']."','$userid','$note','$status')";
				break;
			}
			$j++;
		}
		mysql_query($sqlf3);
		header('refresh:1');
	}
	
	if(isset($_POST['killer']) AND $_POST['killer']!=0){
		$sqlf4="delete from tbl_notes where userid='$ids' AND noteid='".$_POST['killer']."'";
		mysql_query($sqlf4);
		header('refresh:1');
	}
	
	$sql2="select MAX(noteid) as max from tbl_notes where userid='$ids'";
	$rs2=mysql_query($sql2);
	$row2=mysql_fetch_array($rs2);
	$maxnoteid=$row2['max'];
	$nextnoteid=$maxnoteid+1;
	
	$sqlf2="select count(*) as counter from tbl_notes where userid='$ids'";
	$resultf2=mysql_query($sqlf2);
	$dataf2=mysql_fetch_array($resultf2);
	$count=$dataf2['counter'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
.chobi
{	cursor:pointer;
}
.chobi:hover
{	
	-moz-box-shadow: 0 0 3px 3px #888;
	-webkit-box-shadow: 0 0 3px 3px#888;
	box-shadow: 0 0 3px 3px #888;
}
</style>
<script type="text/javascript" src="jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	
	$(document).ready(function(){
		$("#fiframe").fancybox({});
		
		$("#new").click(function(){
				$("#space").html("");
				$("#saver").attr('value',<?php echo $nextnoteid; ?>);
				$("#killer").attr('value',<?php echo $nextnoteid; ?>);
			});
			
		$(".pp").click(function(){
			var xlo=$(this).attr('id');
			
			if(xlo==1)
				{	$("#space").html("<?php echo $note[0]; ?>");
					$("#saver").attr('value',<?php echo $noteid[0]; ?>);
					$("#killer").attr('value',<?php echo $noteid[0]; ?>);
				}
			if(xlo==2)
				{	$("#space").html("<?php echo $note[1]; ?>");
					$("#saver").attr('value',<?php echo $noteid[1]; ?>);
					$("#killer").attr('value',<?php echo $noteid[1]; ?>);
				}
			if(xlo==3)
				{	$("#space").html("<?php echo $note[2]; ?>");
					$("#saver").attr('value',<?php echo $noteid[2]; ?>);
					$("#killer").attr('value',<?php echo $noteid[2]; ?>);
				}
			if(xlo==4)
				{	$("#space").html("<?php echo $note[3]; ?>");
					$("#saver").attr('value',<?php echo $noteid[3]; ?>);
					$("#killer").attr('value',<?php echo $noteid[3]; ?>);
				}
			if(xlo==5)
				{	$("#space").html("<?php echo $note[4]; ?>");
					$("#saver").attr('value',<?php echo $noteid[4]; ?>);
					$("#killer").attr('value',<?php echo $noteid[4]; ?>);
				}
			if(xlo==6)
				{	$("#space").html("<?php echo $note[5]; ?>");
					$("#saver").attr('value',<?php echo $noteid[5]; ?>);
					$("#killer").attr('value',<?php echo $noteid[5]; ?>);
				}
			if(xlo==7)
				{	$("#space").html("<?php echo $note[6]; ?>");
					$("#saver").attr('value',<?php echo $noteid[6]; ?>);
					$("#killer").attr('value',<?php echo $noteid[6]; ?>);
				}
			if(xlo==8)
				{	$("#space").html("<?php echo $note[7]; ?>");
					$("#saver").attr('value',<?php echo $noteid[7]; ?>);
					$("#killer").attr('value',<?php echo $noteid[7]; ?>);
				}
			if(xlo==9)
				{	$("#space").html("<?php echo $note[8]; ?>");
					$("#saver").attr('value',<?php echo $noteid[8]; ?>);
					$("#killer").attr('value',<?php echo $noteid[8]; ?>);
				}
			if(xlo==10)
				{	$("#space").html("<?php echo $note[9]; ?>");
					$("#saver").attr('value',<?php echo $noteid[9]; ?>);
					$("#killer").attr('value',<?php echo $noteid[9]; ?>);
				}
					
		});
	});
	
</script>
</head>

<body>
<br />
<br />
<br />
<table border="0" width="100%">
	<tr>
		<?php
			$temp=1;
			while($temp <= $count){
		?>
		<td width="22px" class="pp" id="<?php echo $temp; ?>">
			<img class="chobi" src="images/edit-notes.png">
		</td>
		<?php
			$temp++;
			}
			if($count<10){
		?>
		<td width="22px" id="new">
			<img class="chobi" src="images/add-notes.png">
		</td>
		<?php
			}
		?>
		<td>
		<form name="formnote" action="" method="post">
			<textarea name="note" id="space" rows="1" cols="100" style="font-family:Arial; font-size:12px; background-color:transparent; border:#333333 dotted"></textarea>
			<input id="saver" name="saver" type="image" src="images/notesave.png" value="0" /><!-- save button -->
			<input id="killer" name="killer" type="image" src="images/notedel.png" value="0" /><!-- del button -->
		</form>
		</td>
	<!--	<td width="130px">
			<a id="fiframe" href="feedback.php"><img src="images/feedback.png" /></a>
		</td>-->
	</tr>
</table>
</body>
</html>