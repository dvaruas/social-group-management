// JavaScript Document
$(document).ready(function(){
	
	
	$('.moim').click(function(){
		$(this).next('.moima').slideToggle("slow","swing");
	});
	
	$('.incomment').click(function(){
		$(this).next('.commenta').slideToggle("slow","swing");
	});
	
	//hide message_body for all
	$("*.message_list .message_body").hide();

	
	//toggle message_body
	$(".message_head").click(function(){
		$(this).next(".message_body").slideToggle(500)
		return false;
	});
	
});