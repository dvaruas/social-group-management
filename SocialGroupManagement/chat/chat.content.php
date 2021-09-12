<?php 
session_start();
include('../include/db.php');
if(isset($_GET['receiverid']) && isset($_GET['message'])) {
  if(trim($_GET['message']) != "") {
    $message = strip_tags(mysql_real_escape_string(trim($_GET['message'])));  
    //$user    = strip_tags(mysql_real_escape_string(trim($_GET['user'])));  
	
	//$_SESSION['receiverid'] = $_GET['receiverid'];
	//$message="hello";
	//echo  $_SESSION['receiverid'];
	if(isset($_SESSION['first']) && ($_SESSION['first']!='')){
		$status=0;
	}
	else{
		$_SESSION['first']=1;
		$status=1;
	}
	$s = "INSERT INTO tbl_chat(userid,receiverid,message,posted,status) VALUES ('".$_SESSION['id']."', '".$_GET['receiverid']."','$message',NOW(),'$status')";
    $q = mysql_query($s) or die(mysql_error());
	$_SESSION['flag']=0;
  }
}
	
  $s = "select * from (SELECT * FROM tbl_chat WHERE (DAY(posted) = DAY(CURDATE()) AND MONTH(posted) = MONTH(CURDATE()) AND YEAR(posted) = YEAR(CURDATE())) ORDER BY posted DESC) AS A where (userid='".$_SESSION['id']."' and receiverid='".$_GET['receiverid']."') or (userid='".$_GET['receiverid']."' and receiverid='".$_SESSION['id']."')";
  $q = mysql_query($s) or die(mysql_error());  
	
?>
<?php while($r = mysql_fetch_array($q)) {
		$sql="select * from tbl_user where id='".$r['userid']."'" ;
		$rs=mysql_query($sql);
		$row=mysql_fetch_array($rs);
  	if($r['userid'] == $_SESSION['id']) 
  		$user_bg = '#2C50A2'; 
	else 
		$user_bg = '#FF3333'; 
?>
    <div style="color:<?php echo $user_bg; ?>"><?php echo "<strong>" . $row['name'] . " says:</strong> " . date('g:i:s a', strtotime($r['posted'])); ?></div>
    <div style="padding-left:5px; padding-bottom:15px;"><?php echo $r['message']; ?></div>
<?php } ?>