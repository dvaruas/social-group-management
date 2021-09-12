<?php
	session_start();
	include('../include/db.php');
 // $_SESSION['receiverid']=$_GET['id'];
  	$sql="select * from tbl_user where id='".$_GET['id']."'";
	$rs=mysql_query($sql);
	$row=mysql_fetch_array($rs);
?>

<html>
<head>
<meta />
<title>Chat with <?php echo $row['name']; ?></title>
<script type="text/javascript">
  function getPage(page, id) {
    var xmlhttp=false; //Clear our fetching variable
    try {
      //Try the first kind of active x object	
      xmlhttp = new ActiveXObject('Msxml2.XMLHTTP'); 
    } catch (e) {    
      try {
        //Try the second kind of active x object
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP'); 
      } catch (E) {
        xmlhttp = false;
      }
    }
   
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    var file = page; 
    xmlhttp.open('GET', file, true);   
    xmlhttp.onreadystatechange=function() {
      //Check if it is ready to recieve data
      if (xmlhttp.readyState==4) { 
        var content = xmlhttp.responseText;
        if( content ) { 
          document.getElementById(id).innerHTML = content; 
        }
      }
    }
    xmlhttp.send(null) //Nullify the XMLHttpRequest
    return;
  }

  function chat() {  
    //var user     = document.getElementById('user').value;
    var message  = document.getElementById('message').value;
	var receiverid  = document.getElementById('receiverid').value;

	getPage("chat.content.php?receiverid=" + receiverid + "&message=" + message,"screen"); 
    //getPage("chat.content.php?message=" + message,"screen");
	document.getElementById('message').value = "";
	document.forms["frmchat"].submit();
  
  }
  
  function getMessage(receiverid) {
  	getPage("chat.content.php?receiverid=" + receiverid,"screen");
  }
  
</script>
</head>
<style type="text/css">
body {
	font-family: Kokila;
  font:12px;
}
	
#panel {
	position:absolute;
	left:20%;
	top:10%;
  border:1px solid #cccccc; 
  height:400px; 
  width:350px;
  padding:5px;
}
	
#title {
  margin-bottom:5px;
}
	
#screen {
  width:340px; 
  height:340px; 
  border:1px solid #cccccc;
  margin-bottom:5px;
  overflow-x:hidden;
  overflow-y:auto;
  background-color:#FFFFFF;
}
	
#input {
  float:left; 
  margin-right:5px;
}
	
#send {
  float:left;
}
	
#user {
  border:1px solid #cccccc; 
  width:150px;
}
	
#message {
	height:50px;
	width:280px; 
  border:1px solid #cccccc;
}
#post
{	opacity:0.7;
}
#post:hover
{	opacity:1.0;
}
</style>
<body>
<script type="text/javascript">
	process = setInterval("getMessage('<?php echo $_GET['id']; ?>')", 1000);
</script>
<p style="font-family:Andalus; font-size:24px">You're now chatting with <?php echo $row['name']; ?></p>
<div id="panel"> 
  <div id="screen"></div>
  <div>
    <div id="input">
	
	<input type="hidden" name="receiverid" id="receiverid" value="<?php echo $_GET['id']; ?>" />

      <textarea name="message" id="message"></textarea>
    </div>
    <div id="send">
      <input type="image" src="../images/chat.jpg" name="post" id="post" maxlength="500" value="Post" onClick="javascript:chat();" />
    </div>
  </div> 
</div>
</body>
</html>
