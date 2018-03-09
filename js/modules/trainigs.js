$(function(){
	$("#iframe_for_video").each(function(){
		$(this).css({"width":$(this).parent().width()+"px","height":(337/600)*$(this).parent().width()+"px"});
	});	
})