$(function(){
	$(".div_for_info iframe").attr({"id":"iframe_for_video"});
	
	$('#button_1').click(function(){ 
		if (required(["#answer"])) {
			auto_ajax('/homeworks/homework_save/',{'answer':$('#answer').val(),'idnum':$(this).data('idnum'),'id':$(this).data('id')});
		}
	});
})