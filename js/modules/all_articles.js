$(function(){
	var a=0,b=0,c=0; 
	$(".titles").each(function(){ 
		if ($(this).height()>a) { a=$(this).height(); } 
	}); 
	$(".imgs").each(function(){ if ($(this).height()>c) { c=$(this).height(); } }); 
	$(".bodies").each(function(){ if ($(this).height()>b) { b=$(this).height(); } }); 
	$(".titles").css({"height":a+"px"}); $(".bodies").css({"height":b+"px"}); 
	$(".imgs").css({"height":c+"px"}); 
	$(".all_articles").click(function(){ 
		$(".all_articles").css({"font-weight":"normal"}); 
		$(this).css({"font-weight":"700"}); 
		$(".astats").css({"display":"none"}); 
		$(".day"+$(this).data("day")).css({"display":"block"}); 
	}); 
	
	$(".all_articles").hover(
		function(){ $(".all_articles").stop().animate({'opacity':'0.5'},500); $(this).stop().animate({'opacity':'1'},500); },
		function(){ $(".all_articles").stop().animate({'opacity':'1'},500); }
	);
})