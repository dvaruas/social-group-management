<?php
	session_start();
	include('include/db.php');
	//flush();
	if(isset($_POST['submit']) AND ($_POST['submit']=='CreateMyAccount')){
		$name=$_POST['name'];
		$emailid=$_POST['emailid'];
		$sec_emailid=$_POST['sec_emailid'];
		$password=$_POST['password'];
		$location=$_POST['location'];
		$dob=$_POST['birthday'];
		list($day,$month,$year) = explode('/',$dob);
		$birthday=$year."-".$month."-".$day;
		$gender=$_POST['gender'];
		$securityques=$_POST['securityques'];
		$securityans=$_POST['securityans'];
		$status=1;
		$query="select * from tbl_user where emailid='$emailid'";
		$result=mysql_query($query);
		if(mysql_num_rows($result)<>0){
			echo "EmailID already exists.....";
		}
		else{
			$sql="insert into tbl_user(name,emailid,secemailid,password,location,dateofbirth,gender,securityquestion,securityanswer,status) values('$name','$emailid','$sec_emailid','$password','$location','$birthday','$gender','$securityques','$securityans','$status')";
			if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ){
				$rs=mysql_query($sql);
				$query="select MAX(id) as max from tbl_user";
				$rs1=mysql_query($query);
				$row=mysql_fetch_array($rs1);
				$userid=$row['max'];
				$status=1;
				$sql1="insert into tbl_personaldetails(userid,aboutme,languagesknown,gender,sexualorientation,relationshipstatus,status) values('$userid','','','','','','$status')";
				mysql_query($sql1);
				$sql2="insert into tbl_education(userid,primaryschool,highschool,graduation,postgraduation,otherqualification,employee,status) values('$userid','','','','','','','$status')";
				mysql_query($sql2);
				$sql4="insert into tbl_interests(userid,favouritesports,televisionshows,favouritemusics,hobbies,favouritebooks,religiousview,politicalview,status) values('$userid','','','','','','','','$status')";
				mysql_query($sql4);
				$sql5="insert into tbl_contactinfo(userid,emailid,homephoneno,cellphoneno,housenumber,town,city,state,country,status) values('$userid','','','','','','','','','$status')";
				mysql_query($sql5);
				mkdir("../SocialGroupManagement/users/$userid");
				mkdir("../SocialGroupManagement/users/$userid/profilepics");
				mkdir("../SocialGroupManagement/users/$userid/gallery");
				mkdir("../SocialGroupManagement/users/$userid/statusimages");
				header('location:index.php');
			}
			else{
				echo "Please enter your verification code correctly....";
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="dhtmlgoodies-calendar.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="include/script/dhtmlgoodies_calendar.js?random=20060118"></script>
<script type="text/javascript" src="include/script/mootools.v1.11.js"></script>
<script type="text/javascript" src="jquery.js" ></script>
<script language="javascript">
function validation(){
	
	
	//email id
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var adnew = document.formreg.emailid.value;
	
	//sec_emailid
	var reg3 = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var adnew3 = document.formreg.sec_emailid.value;
	
	//password
	var reg2 = /^([A-Za-z0-9_\-\.]{6,20})$/;
	var adnew2 = document.formreg.password.value;
	
	//NAME
	
	if(document.formreg.name.value==""){
		alert("Please enter your name");
		document.formreg.name.focus();
		return false;
	}
	
	//EMAILID
	
	if(reg.test(adnew) == false){
		alert('!!!Invalid Email Address!!!');
		document.formreg.emailid.focus();
		return false;
	}
	
	/*//SECONDARYEMAILID
	
	if(reg3.test(adnew3) == false){
		alert('!!!Invalid Email Address!!!');
		document.formreg.sec_emailid.focus();
		return false;
	}*/
	
	//PASSWORD
	
	if(reg2.test(adnew2) == false){
		alert('Password must contain 6-20 character');
		document.formreg.password.focus();
		return false;
	}
	
	//RETYPE PASSWORD
	
	if(document.formreg.password.value!=document.formreg.repassword.value){
		alert("password and repassword are not same");
		document.formreg.repassword.focus();
		return false;
	}
	
	//LOCATION
	
	if(document.formreg.location.value=="select"){
		alert("Please enter your location");
		document.formreg.location.focus();
		return false;
	}
	
	//DATE OF BIRTH
	
	if(document.formreg.birthday.value==""){
		alert("Please enter your date of birth");
		document.formreg.birthday.focus();
		return false;
	}
	
	//GENDER
	
	if(document.formreg.gender.value==""){
		alert("Please enter your gender");
		document.formreg.gender.focus();
		return false;
	}
	
	
	
	return true;
}

function passwordStrength(password)

{

        var desc = new Array();

        desc[0] = "Very Weak";

        desc[1] = "Weak";

        desc[2] = "Better";

        desc[3] = "Medium";

        desc[4] = "Strong";

        desc[5] = "Strongest";



        var score   = 0;



        //if password bigger than 6 give 1 point

        if (password.length > 2) score++;



        //if password has both lower and uppercase characters give 1 point      

        if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;



        //if password has at least one number give 1 point

        if (password.match(/\d+/)) score++;



        //if password has at least one special caracther give 1 point

        if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;



        //if password bigger than 12 give another 1 point

        if (password.length > 6) score++;



         document.getElementById("passwordDescription").innerHTML = desc[score];

         document.getElementById("passwordStrength").className = "strength" + score;

}
</script>

<script type="text/javascript" >

$(document).ready(function(){
  $("input,textarea").focus(function () {
         $(this).next("span").show("slow").css("display","inline");
    });
  $("input,textarea").focusout(function () {
         $(this).next("span").hide("slow");
    });
});

</script>
<script language="javascript">
	function apply(){
	  document.formreg.submit.disabled=true;
	  if(document.formreg.privacy.checked==true)
	  {
		document.formreg.submit.disabled=false;
		document.formreg.submit.style.display='block';
	  }
	  if(document.formreg.privacy.checked==false)
	  {
		document.formreg.submit.enabled=false;
		document.formreg.submit.style.display='none';
	  }
	}
	function fn1(){
		window.location="index.php";
	}
</script>

<link href="registerpage.css" rel="stylesheet" type="text/css" />
<link href="pass.css" rel="stylesheet" type="text/css" />
</head>
<body style="font-size: 12px; font-weight: bold;">

<form name="formreg" method="post" action=""  onsubmit="return validation();">
	<table width="593" height="650" border="0" id="form_table" align="center">
		<tr>
			<th width="24%">Name &#8250;</th>
			<td width="76%">
			<p>
			<input type="text" name="name" />
			<span>Enter Your Full Name</span> </p>     
			</td>
		</tr>
		<tr>
			<th>Email id &#8250;</th>
			<td>
			<p>
			<input type="text" name="emailid" />
			<span>Your Active Email Address</span>      </p>
			<p>
			
			<input type="text" name="sec_emailid" />
			
			<span>Secondary Email Address</span></p>
			</td>
		</tr>
		<tr>
			<th>Password &#8250;</th>
			<td>
			<p>
			<input type="password" name="password"  onkeyup="passwordStrength(this.value)" />
			<span>Choose Password (>=6)</span></p>
			<p>
			<input type="password" name="repassword" /> 
			<span>Re-enter Password</span></p>
			<p>
				<div id="passwordDescription">Password not entered</div>
				<div id="passwordStrength" class="strength0"></div>
			</p>
			</td>
		</tr>
		<tr>
			<th>Location &#8250;</th>
			<td>
			<?php
				$q="select * from tbl_location order by name";
				$r=mysql_query($q);
			?>
			<select name="location" size="1">
				<option value="select">Select</option>
				<?php
					while($rw=mysql_fetch_array($r)){
				?>
				<option value="<?php echo $rw['name']; ?>"><?php echo $rw['name']; ?></option>
				<?php
					}
				?>
			</select>
			</td>
		</tr>
		<tr>
			<th>Birthday &#8250;</th>
			<td><p><input type="text" name="birthday"  onclick="displayCalendar(document.formreg.birthday,'dd/mm/yyyy',this)" /><span>Select Birthday</span>
			</p></td>
		</tr>
		<tr>
			<th>Gender &#8250;</th>
			<td><p>
				<input type="radio" name="gender"  value="male" />
			Male </p>
			<p>
				<input type="radio" name="gender"  value="female" />
			Female</p>
			</td>
		</tr>
		<tr>
			<th>Verification &#8250;</th>
			<td>
				<p><img src="CaptchaSecurityImages.php?<?php echo rand(); ?>width=100&height=40&characters=5" style="padding-left:10px;" /><br/></p>
				<p><input type="text" name="security_code" />
				<span>Enter characters displayed</span></p>
			</td>
		</tr>
		<tr>
			<th>Security Question &#8250;</th>
			<td>
				<p><input type="text" name="securityques" />
				<span>Enter a secret question</span></p>
			</td>
		</tr>
		<tr>
			<th>Security Answer &#8250;</th>
			<td>
				<p><input type="text" name="securityans" />
				<span>Enter corresponding answer</span></p>
			</td>
		</tr>
		<tr>
			<th></th>
			<td><input type="checkbox" name="privacy" onClick="apply()" /> I Accept</td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="submit" name="submit" value="CreateMyAccount" disabled="true" style="display:none" />
			<input type="button" name="cancel" value="Cancel" align="right" onclick="fn1()" /></td>
		</tr>
	</table>
</form>
</body>
</html>
