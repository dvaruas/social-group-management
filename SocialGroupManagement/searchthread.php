<?php
session_start();
include('include/db.php');
if($_POST)
{

$q=$_POST['searchword'];

$sql_res=mysql_query("select * from tbl_user where name like '%$q%' order by id LIMIT 5");
while($row=mysql_fetch_array($sql_res))
{
$sql="select * from tbl_thread where (initiatorid='".$row['id']."' and receiverid='".$_SESSION['id']."') or (receiverid='".$row['id']."' and initiatorid='".$_SESSION['id']."')";
$rs=mysql_query($sql);
if(mysql_num_rows($rs)<>0){
$fname=$row['name'];
$re_fname='<b>'.$q.'</b>';
$final_fname = str_ireplace($q, $re_fname, $fname);
?>


<div class="display_box" align="left">
<a href="messages.php?uid=<?php echo $row['id']; ?>" style="text-decoration:none; color:#000000">
<table style="margin:0px; padding:0px">
	<tr>
		<td rowspan="2">

<?php
	$filename="users/".$row['id']."/profilepics/thumbnail_pic.jpg";
	$filename1="users/".$row['id']."/profilepics/resized_pic.jpg";
	if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($row['gender']=='male')){
?>
<img src="images/profile_pic.jpg" width="25" height="25" style="padding-bottom:10px;" />
<?php
	}
	else if(!file_exists ( $filename ) && !file_exists ( $filename1 ) && ($row['gender']=='female')){
?>
<img src="images/profile_pic_f.jpg" width="25" height="25" style="padding-bottom:10px;" />
<?php
	}
	else if(!file_exists ( $filename ) && file_exists ( $filename1 )){
?>

<img src="users/<?php echo $row['id']; ?>/profilepics/resized_pic.jpg" width="25" height="25" style="padding-bottom:10px;" />


<?php
	}
	else{
?>

<img src="users/<?php echo $row['id']; ?>/profilepics/thumbnail_pic.jpg" width="25" height="25" style="padding-bottom:10px;" />


<?php
	}
?>
		</td>
		<td>
			<?php echo $final_fname; ?>
		</td>
	</tr>
	<tr>
		<td>
<p style="font-size:9px; color:#666666"><?php echo $row['location']; ?></p>
		</td>
	</tr>
</table>
</a>

</div>



<?php
}

}
}
else
{

}


?>
