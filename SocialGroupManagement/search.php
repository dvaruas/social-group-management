<?php
include('include/db.php');
if($_POST)
{

$q=$_POST['searchword'];

$sql_res=mysql_query("select * from tbl_user where name like '%$q%' order by id LIMIT 5");
while($row=mysql_fetch_array($sql_res))
{
$fname=$row['name'];
$re_fname='<b>'.$q.'</b>';
$final_fname = str_ireplace($q, $re_fname, $fname);
?>

<div class="display_box" align="left">
<a href="oprofile.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:#000000">
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

$sql_grp=mysql_query("select * from tbl_group where name like '%$q%' order by id LIMIT 5");
while($row1=mysql_fetch_array($sql_grp)){
	$gname=$row1['name'];
	$re_gname='<b>'.$q.'</b>';
	$final_gname = str_ireplace($q, $re_gname, $gname);
?>
<div class="display_box" align="left">
	<a href="group.php?a=0&gid=<?php echo $row1['id']; ?>" style="text-decoration:none; color:#000000">
	<table style="margin:0px; padding:0px">
	<tr>
		<td rowspan="2">
	<?php
		$grpname="groups/".$row1['id']."/profilepics/".$row1['id'].".jpg";
		if(!file_exists ( $grpname )){
	?>
	<img src="images/default-group-image.gif" width="25" height="25" style="padding-bottom:10px;" />
	<?php 
		}
		else{
	?>
	<img src="groups/<?php echo $row1['id']; ?>/profilepics/<?php echo $row1['id']; ?>.jpg" width="25" height="25" style="padding-bottom:10px;" />
	<?php
		}
	?>
	</td>
	<td>
		<?php echo $final_gname; ?>
	</td>
</tr>
<tr>
	<td>
		<p style="font-size:9px; color:#666666">Group</p>
	</td>
</tr>
</table>
</a>
</div>
<?php 
}
}
else
{

}


?>
