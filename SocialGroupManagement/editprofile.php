<?php
	session_start();
	include('include/db.php');
	
	$query1="select * from tbl_personaldetails where userid='".$_SESSION['id']."'";
	$rs1=mysql_query($query1);
	$row1=mysql_fetch_array($rs1);
	
	$query2="select * from tbl_education where userid='".$_SESSION['id']."'";
	$rs2=mysql_query($query2);
	$row2=mysql_fetch_array($rs2);
	
	$query3="select * from tbl_interests where userid='".$_SESSION['id']."'";
	$rs3=mysql_query($query3);
	$row3=mysql_fetch_array($rs3);
	
	$query4="select * from tbl_contactinfo where userid='".$_SESSION['id']."'";
	$rs4=mysql_query($query4);
	$row4=mysql_fetch_array($rs4);
	
	
	
	if(isset($_POST['submit']) AND ($_POST['submit']=='Done')){
	
		//PERSONAL DETAILS
		$aboutme=$_POST['aboutme'];
		$languages=$_POST['languages'];
		$gender=$_POST['gender'];
		$sexualorientation=$_POST['sexualorientation'];
		$relationship=$_POST['relationship'];
		$sql1="update tbl_personaldetails set aboutme='$aboutme',languagesknown='$languages',gender='$gender',sexualorientation='$sexualorientation',relationshipstatus='$relationship' where userid='".$_SESSION['id']."'";
		mysql_query($sql1);
		
		//EDUCATIONAL DETAILS
		$primaryschool=$_POST['primaryschool'];
		$highschool=$_POST['highschool'];
		$graduation=$_POST['graduation'];
		$postgraduation=$_POST['postgraduation'];
		$otherqualification=$_POST['otherqualification'];
		$employee=$_POST['employee'];
		$sql2="update tbl_education set primaryschool='$primaryschool',highschool='$highschool',graduation='$graduation',postgraduation='$postgraduation',otherqualification='$otherqualification',employee='$employee' where userid='".$_SESSION['id']."'";
		mysql_query($sql2);
		
		//INTERESTS
		$sports=$_POST['sports'];
		$tvshow=$_POST['tvshow'];
		$music=$_POST['musics'];
		$hobbies=$_POST['hobbies'];
		$books=$_POST['books'];
		$religiousviews=$_POST['religiousview'];
		$politicalviews=$_POST['politicalview'];
		$sql3="update tbl_interests set favouritesports='$sports',televisionshows='$tvshow',favouritemusics='$music',hobbies='$hobbies',favouritebooks='$books',religiousview='$religiousviews',politicalview='$politicalviews' where userid='".$_SESSION['id']."'";
		mysql_query($sql3);
		
		//CONTACT INFORMATION
		$emailid=$_POST['email'];
		$homephone=$_POST['homephone'];
		$cellphone=$_POST['cellphone'];
		$houseno=$_POST['houseno'];
		$town=$_POST['town'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$country=$_POST['country'];
		$sql4="update tbl_contactinfo set emailid='$emailid',homephoneno='$homephone',cellphoneno='$cellphone',housenumber='$houseno',town='$town',city='$city',state='$state',country='$country' where userid='".$_SESSION['id']."'";
		mysql_query($sql4);
		header('location:homes.php');
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="jquery.min.js"></script>
 <script type="text/javascript">

    jQuery(function($){
	 
	 $(".tab_content").hide();
	$(".tab_content:first").show(); 
	
	 $("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn(); 
	 });


    });

  </script>


<style type="text/css">
body
{	background: url(images/wall3.jpg);
}

	ul.tabs {
		margin: 0;
		padding: 0;
		float: left;
		list-style: none;
		height: 32px;
		border-bottom: 1px solid #999999;
		border-left: 1px solid #999999;
		width: 100%;
	}
	ul.tabs li {
		float: left;
		margin: 0;
		cursor: pointer;
		padding: 0px 21px ;
		height: 31px;
		line-height: 31px;
		border: 1px solid #999999;
		border-left: none;
		p-weight: bold;
		background: #EEEEEE;
		overflow: hidden;
		position: relative;
	}
	ul.tabs li:hover {
		background: #CCCCCC;
	}	
	ul.tabs li.active{
		background: #FFFFFF;
		border-bottom: 1px solid #FFFFFF;
	}
	.tab_container {
		border: 1px solid #999999;
		border-top: none;
		clear: both;
		float: left; 
		width: 100%;
		background: #FFFFFF;
		opacity:0.8;
	}
	.tab_content {
		padding: 20px;
		p-size: 1.2em;
		display: none;
	}
	#container {
		width: 600px;
		margin: 0 auto;	
		position:absolute;
		top:10%;
		left:23%;
	}
</style>

</head>

<body>
<div id="container">

  <ul class="tabs"> 
        <li class="active" rel="tab1"> Personal Details</li>
		<li rel="tab2"> Education Details </li>
        <li rel="tab3"> Interests </li>
        <li rel="tab4"> Contact Information</li>
    </ul>
<form name="details" action="" method="post" enctype="multipart/form-data">
<div class="tab_container" style="position:relative"> 

     <div id="tab1" class="tab_content">
	 <table>
	 <tr>
	  <td width="139"> <p style=" font-family:Andalus; font-size:14px "> About me </p></td>
	 <td width="526">
	
<textarea name="aboutme" placeholder="Write about your-self.This text would be visible to a user when he/she visits your profile." cols="30" rows="5"><?php echo $row1['aboutme']; ?>
</textarea>
	 </td>
	 </tr>
	 <tr>
	 	<td>
			<p style=" font-family:Andalus; font-size:14px "> Languages I know </p>
		</td>
	  
	  	<td>
	  <select name="languages">
	  <option>Select</option>
<option value="Afrikaans">Afrikaans</option>
<option value="Albanian">Albanian</option>
<option value="Amharic">Amharic</option>
<option value="Arabic">Arabic</option>
<option value="Armenian">Armenian</option>
<option value="Basque">Basque</option>
<option value="Bengali">Bengali</option>
<option value="Bhojpuri">Bhojpuri</option>
<option value="Byelorussian">Byelorussian</option>
<option value="Burmese">Burmese</option>
<option value="Bulgarian">Bulgarian</option>
<option value="Catalan">Catalan</option>
<option value="Czech">Czech</option>
<option value="Chinese">Chinese</option>
<option value="Croatian">Croatian</option>
<option value="Danish">Danish</option>
<option value="Dari">Dari</option>
<option value="Dzongkha">Dzongkha</option>
<option value="Dutch">Dutch</option>
<option value="Dutch">English</option>
<option value="Esperanto">Esperanto</option>
<option value="Estonian">Estonian</option>
<option value="Faroese">Faroese</option>
<option value="Farsi">Farsi</option>
<option value="Finnish">Finnish</option>
<option value="French">French</option>
<option value="Gaelic">Gaelic</option>
<option value="Galician">Galician</option>
<option value="German">German</option>
<option value="Greek">Greek</option>
<option value="Gaelic">Gaelic</option>
<option value="Galician">Galician</option>
<option value="German">German</option>
<option value="Greek">Greek</option>
<option value="Gujarati">Gujarati</option>
<option value="Hindi">Hindi</option>
<option value="Icelandic">Icelandic</option>
<option value="Indonesian">Indonesian</option>
<option value="Inuktitut(Eskimo)">Inuktitut (Eskimo)</option>
<option value="Italian">Italian</option>
<option value="Japanese">Japanese</option>
<option value="Kannad">Kannad</option>
<option value="Khmer">Khmer</option>
<option value="Korean">Korean</option>
<option value="Kurdish">Kurdish</option>
<option value="Laotian">Laotian</option>
<option value="Latin">Latin</option>
<option value="Latvian">Latvian</option>
<option value="Lappish">Lappish</option>
<option value="Lithuanian">Lithuanian</option>
<option value="Macedonian">Macedonian</option>
<option value="Malay">Malay</option>
<option value="Maltese">Maltese</option>
<option value="Marathi">Marathi</option>
<option value="Nepali">Nepali</option>
<option value="Norwegian">Norwegian</option>
<option value="Pashto">Pashto</option>
<option value="Polish">Polish</option>
<option value="Portuguese">Portuguese</option>
<option value="Romanian">Romanian</option>
<option value="Russian">Russian</option>
<option value="Scots">Scots</option>
<option value="Serbian">Serbian</option>
<option value="Slovak">Slovak</option>
<option value="Slovenian">Slovenian</option>
<option value="Somali">Somali</option>
<option value="Spanish">Spanish</option>
<option value="Swedish">Swedish</option>
<option value="Swahili">Swahili</option>
<option value="Tagalog-Filipino">Tagalog-Filipino</option>
<option value="Tajik">Tajik</option>
<option value="Tamil">Tamil</option>
<option value="Telegu">Telegu</option>
<option value="Thai">Thai</option>
<option value="Tibetan">Tibetan</option>
<option value="Tigrinya">Tigrinya</option>
<option value="Tongan">Tongan</option>
<option value="Turkish">Turkish</option>
<option value="Turkmen">Turkmen</option>
<option value="Ucrainian">Ucrainian</option>
<option value="Urdu">Urdu</option>
<option value="Uzbek">Uzbek</option>
<option value="Vietnamese">Vietnamese</option>
<option value="Welsh">Welsh</option>
</select>
	  </td>	  
	 </tr>
	 
	 
	<tr>
	 	<td> 
			<p style=" font-family:Andalus; font-size:14px "> Gender </p>
		</td>
	 	<td>
	 <select name="gender">
<option value="Male"<?php if($row1['gender']=='Male'){ echo "selected";}?>>Male</option>
<option value="Female"<?php if($row1['gender']=='Female'){ echo "selected";}?>>Female</option>
<option value="None of the above" <?php if($row1['gender']=='None of the above'){ echo "selected";}?>>None of the above</option>
</select>
		</td>
	</tr>
	 
	 
	 <tr>
	 	<td>
			<p style=" font-family:Andalus; font-size:14px "> Sexual orientation </p>
		</td>
	 	<td>
	 <select name="sexualorientation">
	 <option>Select</option>
<option value="Straight"<?php if($row1['sexualorientation']=='Straight'){ echo "selected";}?>>Straight</option>
<option value="Gay"<?php if($row1['sexualorientation']=='Gay'){ echo "selected";}?>>Gay</option>
<option value="Lesbian"<?php if($row1['sexualorientation']=='Lesbian'){ echo "selected";}?>>Lesbian</option>
<option value="Bi"<?php if($row1['sexualorientation']=='Bi'){ echo "selected";}?>>Bi</option>
</select>
		</td>
	</tr>
	
	 
	 <tr>
	 	<td>
			<p style=" font-family:Andalus; font-size:14px "> Relationship Status </p>
		</td>
	 	<td>
	 <select name="relationship">
	 <option>Select</option>
<option value="Not Saying"<?php if($row1['relationshipstatus']=='Not Saying'){ echo "selected";}?>>Not Saying</option>
<option value="Single"<?php if($row1['relationshipstatus']=='Single'){ echo "selected";}?>>Single</option>
<option value="Committed"<?php if($row1['relationshipstatus']=='Committed'){ echo "selected";}?>>Committed</option>
<option value="Engaged"<?php if($row1['relationshipstatus']=='Engaged'){ echo "selected";}?>>Engaged</option>
<option value="Married"<?php if($row1['relationshipstatus']=='Married'){ echo "selected";}?>>Married</option>
<option value="Awaiting divorce"<?php if($row1['relationshipstatus']=='Awaiting divorce'){ echo "selected";}?>>Awaiting divorce</option>
<option value="Divorced"<?php if($row1['relationshipstatus']=='Divorced'){ echo "selected";}?>>Divorced</option>
<option value="Widowed"<?php if($row1['relationshipstatus']=='Widowed'){ echo "selected";}?>>Widowed</option>
<option value="anulled"<?php if($row1['relationshipstatus']=='anulled'){ echo "selected";}?>>anulled</option>
<option value="Complicated"<?php if($row1['relationshipstatus']=='Complicated'){ echo "selected";}?>>Complicated</option>
<option value="Open relationship"<?php if($row1['relationshipstatus']=='Open relationship'){ echo "selected";}?>>Open relationship</option>
</select>
	 	</td>
	 </tr>

	</table>
	 </div>
							<!-- about me end -->	 
<!--------------------------------------------------------------------------------------------------->
	 <div id="tab2" class="tab_content"> 
 		<table>
 		 <tr>
		 <td width="150px"><p style=" font-family:Andalus; font-size:14px "> Primary school </p></td>
		 <td><input type="text" name="primaryschool" placeholder="School name" value="<?php echo $row2['primaryschool']; ?>" /></td>
		 </tr>
		
         <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> High school </p></td>
		 <td><input type="text" name="highschool" placeholder="High School name" value="<?php echo $row2['highschool']; ?>" /></td>
		 </tr>
		
		 <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Graduation </p></td>
		 <td><input type="text" name="graduation" placeholder="College/University name" value="<?php echo $row2['graduation']; ?>" /></td>
		 </tr>
		 
		 <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Post Graduation</p></td>
		 <td><input type="text" name="postgraduation" placeholder="College/University name"value="<?php echo $row2['postgraduation']; ?>"  /></td>
		 </tr>
		 
		 
		 <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Other Qualification</p></td>
		 <td><input type="text" name="otherqualification" placeholder="Qualifications" value="<?php echo $row2['otherqualification']; ?>" /></td>
		 </tr>
		 
		 
		 <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Employee</p></td>
		 <td><input type="text" name="employee" placeholder="Profession/Company name" value="<?php echo $row2['employee']; ?>" /></td>
		 </tr>
		 
	    </table>
	

     </div><!-- #tab1 -->

							<!-- Education details end -->	 
<!--------------------------------------------------------------------------------------------------->

     <div id="tab3" class="tab_content"> 

	<table>       
	     <tr>
		 <td width="150px"><p style=" font-family:Andalus; font-size:14px "> Favourite sport</p></td>
		 <td><input type="text" name="sports" placeholder="Sport name" value="<?php echo $row3['favouritesports']; ?>" /></td>
		 </tr>
		 
		
		 <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Television show </p></td>
		 <td><input type="text" name="tvshow" placeholder="Show name" value="<?php echo $row3['televisionshows']; ?>" /></td>
		 </tr>
		 		 
		  <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Favourite music</p></td>
		 <td><input type="text" name="musics" placeholder="Enter genre" value="<?php echo $row3['favouritemusics']; ?>" /></td>
		 </tr>
		 
		 <tr>
		 <td><p style=" font-family:Andalus; font-size:14px ">Hobbies/Interests</p></td>
		 <td><input type="text" name="hobbies" placeholder="Enter hobbies" value="<?php echo $row3['hobbies']; ?>" /></td>
		 </tr>
		 
		 <tr>		 
		 <td><p style=" font-family:Andalus; font-size:14px "> Favourite books</p></td>
		 <td><input type="text" name="books" placeholder="Enter books" value="<?php echo $row3['favouritebooks']; ?>" /></td>
		 </tr>
		 		
		 <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Religious views</p></td>
		 <td><input type="text" name="religiousview" placeholder="Enter views" value="<?php echo $row3['religiousview']; ?>" /></td>
		 </tr>
		 
		
	     <tr>
		 <td><p style=" font-family:Andalus; font-size:14px "> Political views</p></td>
		 <td><input type="text" name="politicalview" placeholder="Enter political views" value="<?php echo $row3['politicalview']; ?>" /></td>
		 </tr>
		 
		 
	    </table>
		
      </div><!-- #tab2 -->
			
										<!-- Interests end -->	 
<!--------------------------------------------------------------------------------------------------->

			
     <div id="tab4" class="tab_content" > 

	<table>
     <tr>
		 <td width="150px"><p style=" font-family:Andalus; font-size:14px "> E-mail id</p></td>
		 <td colspan="2"><input type="text" name="email" placeholder="Enter email" value="<?php echo $row4['emailid']; ?>" /></td>
	</tr>
	
	
	<tr>
		<td rowspan="2" width="150px">
	 		<p style=" font-family:Andalus; font-size:14px "> Phone </p>
	 	</td>
	    <td>
			<p style=" font-family:Andalus; font-size:14px "> Home </p>
		</td>
		<td>
			<input type="text" placeholder="Enter home number" name="homephone" value="<?php echo $row4['homephoneno']; ?>"  />
		</td>
	</tr>
	<tr>
		<td>
			<p style=" font-family:Andalus; font-size:14px "> Cell </p>
		</td>
		<td>
			<input type="text" placeholder="Enter cell number" name="cellphone" value="<?php echo $row4['cellphoneno']; ?>"  />
		</td>
	</tr>
		 
		 
	<tr>
		<td rowspan="5">
			<p style=" font-family:Andalus; font-size:14px "> Address </p>
		</td>
		<td>
			<p style=" font-family:Andalus; font-size:14px "> House number </p>
		</td>
		<td>
			<input type="text" name="houseno" placeholder="Enter House no" value="<?php echo $row4['housenumber']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			<p style=" font-family:Andalus; font-size:14px "> Town </p>
		</td>
		<td>
			<input type="text" name="town" placeholder="Enter Town" value="<?php echo $row4['town']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			<p style=" font-family:Andalus; font-size:14px "> City </p>
		</td>
		<td>
			<input type="text" name="city" placeholder="Enter City" value="<?php echo $row4['city']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			<p style=" font-family:Andalus; font-size:14px "> State </p>
		</td>
		<td>
			<input type="text" name="state" placeholder="Enter State" value="<?php echo $row4['state']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			<p style=" font-family:Andalus; font-size:14px "> Country </p>
		</td>
		<td>
			<input type="text" name="country" placeholder="Enter country" value="<?php echo $row4['country']; ?>" />
		</td>
	</tr>
</table>
     </div><!-- #tab3 -->

									<!-- Interests end -->	 
<!--------------------------------------------------------------------------------------------------->

	 
	 


 </div> <!-- .tab_container --> 
 
 <input type="submit" value="Done" name="submit"  /> 
 </form>

</div> <!-- #container -->
</body>
</html>
