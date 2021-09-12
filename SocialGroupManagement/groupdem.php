<iframe frameborder="0" allowtransparency="1" src="groupsgrid.php?uid=<?php echo $_GET['uid'] ; ?>" style="height:250px; width:520px; background-image:url(images/iframeback.jpg)">
</iframe>
<script type="text/javascript">
	function closer(ids)
	{	parent.$.fancybox.close();
		window.location="group.php?a=0&gid="+ids;
	}
</script>