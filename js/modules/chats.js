$(function(){
	$("#chat_body").css({"height":$("body").height()-370+"px"});
	$(window).resize(function(){
		$("#chat_body").css({"height":$("body").height()-370+"px"});
	})
})