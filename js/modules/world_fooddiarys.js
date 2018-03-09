$(function(){
	$('input,select,textarea').attr({"disabled":"disabled"}).css({"border":"0px solid #fff","background":"#fff"});
	
	$('#comment').parent().html($('#comment').val()).css({"margin-bottom":"20px"});
	$('#otvet').parent().html($('#otvet').val());
	
	$("#button_1,#button_2").css({"display":"none"});
	$("#button_3").parent().css({"display":"block"});
	
	$("#button_3").click(function(){ go('/world_fooddiarys/',1); });
	
	$(".fooddiary_div_menu_2").each(function(){ if ($(this).val()=="") { $(this).parent().parent().remove(); } });
})