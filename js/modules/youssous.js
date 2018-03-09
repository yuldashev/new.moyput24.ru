$(function(){
	$(".div_for_info iframe").each(function(){
		$(this).css({"width":$(this).parent().width()+"px","height":(337/600)*$(this).parent().width()+"px"});
	});	
	
	$('#button_1').click(function(){ 
		if (required(["#answer"])) {
			auto_ajax('/youssous/youssou_save/',{'answer':$('#answer').val(),'idnum':$(this).data('idnum'),'id':$(this).data('id')});
		}
	});
})