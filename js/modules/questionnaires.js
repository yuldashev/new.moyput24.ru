$(function(){
	$('#questionnaire_save').click(function(){ 
		if (required(["#edit_1","#edit_2","#edit_3","#edit_4","#edit_5","#edit_7","#edit_8","#edit_9","#edit_12","#edit_13","#edit_14","#edit_15","#edit_16"])) {
			auto_ajax('/questionnaires/questionnaires_save/',{'edit_1':$('#edit_1').val(),'edit_2':$('#edit_2').val(),'edit_3':$('#edit_3').val(),'edit_4':$('#edit_4').val(),'edit_5':$('#edit_5').val(),'edit_6':$('#edit_6').val(),'edit_7':$('#edit_7').val(),'edit_8':$('#edit_8').val(),'edit_9':$('#edit_9').val(),'edit_10':$('#edit_10').val(),'edit_11':$('#edit_11').val(),'edit_12':$('#edit_12').val(),'edit_13':$('#edit_13').val(),'edit_14':$('#edit_14').val(),'edit_15':$('#edit_15').val(),'edit_16':$('#edit_16').val(),'edit_17':$('#edit_17').val()});
		}
	});
})