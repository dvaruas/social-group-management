<iframe frameborder="0" allowtransparency="1" src="connecttogrid.php?uid=<?php echo $_GET['uid'] ; ?>" style="height:250px; width:520px; background-image:url(images/iframeback.jpg)">
</iframe>
<script type="text/javascript">
	function closer(ids)
	{	parent.$.fancybox.close();
		window.location="oprofile.php?id="+ids;
	}
</script>