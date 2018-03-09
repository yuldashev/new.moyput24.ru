$(function(){
	$(".workface").hover(
		function(){ $(".workface").stop().animate({'opacity':'0.5'},500); $(this).stop().animate({'opacity':'1'},500); },
		function(){ $(".workface").stop().animate({'opacity':'1'},500); }
	);
	
	$(".workface").click(function(){
		 window.location.href = $(this).data("link");
	});
	
	$('.worktitle').each(function(){
		$(this).css({"bottom":($(this).parent().height()-$(this).height())/2+"px"});
	});
	
	if ($('.youssous_go').length) {
		$('.youssous_go').eq(0).click();
	}
})