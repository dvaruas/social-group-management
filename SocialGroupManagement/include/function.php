<?php
	function secure(){
		if($_SESSION['user_login_flag']!=1){
			header('location:index.php');
			exit;
		}
	}
	function get_file_extension($file_name)
	{
	  //return substr(strrchr($file_name,'.'),1);
	  //return end(explode('.',$file_name));
	  $l=strlen($file_name);
	  $file[10]=$file_name;
	  for($i=0;$i<$l;$i++){
	  	if($file[$i]=='.'){
				$pos=$i;
				break;
		}
	  }
	  return substr($file_name,-$pos);
	}
	function f_extension($fn){
		$str=explode('/',$fn);
		$len=count($str);
		$str2=explode('.',$str[($len-1)]);
		$len2=count($str2);
		$ext=$str2[($len2-1)];
		return ".".$ext;
	}
?>
