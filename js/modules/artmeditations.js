$(function(){
	$(".div_for_info iframe").each(function(){
		$(this).css({"width":$(this).parent().width()+"px","height":(337/600)*$(this).parent().width()+"px"});
	});	
	
	$('#button_2').click(function(){ 
		auto_ajax('/artmeditations/artmeditation_save/',{'idnum':$(this).data('idnum'),'id':$(this).data('id')});
	});
})