$(function(){
	$('.fooddiary_menu_right input').live('keyup',function(){ new_fooddiary_menu_line(); });
	$('#button_1,#button_2').click(function(){ 
		if (($(this).attr('id')=='button_2')&&(!required(["#ves_1","#ves_2","#comment"]))) {
			return false;
		}
		auto_ajax('/fooddiarys/fooddiary_save/',{'ves_1':$('#ves_1').val(),'ves_2':$('#ves_2').val(),'comment':$('#comment').val(),'menu':create_array([".fooddiary_div_menu_0",".fooddiary_div_menu_1",".fooddiary_div_menu_2"]),'type':$(this).attr('id'),'id':$(this).data('id'),'idnum':$(this).data('idnum')});
	});
})

function new_fooddiary_menu_line(){
	var test=false;
	$('.fooddiary_menu_right').each(function(){
		if (($(this).children('input').length)&&($(this).children('input').val()=='')) { if (test) { $(this).parent().remove(); } test=true; }
	});
	if (!test) {
		$('#fooddiary_menu').append('<div class="fooddiary_div_menu" style="margin-top:15px;"><p class="fooddiary_menu_left"><select class="input fooddiary_div_menu_0"><option value="Завтрак" >Завтрак</option><option value="Обед" >Обед</option><option value="Ужин" >Ужин</option><option value="Перекус">Перекус</option></select></p><p class="fooddiary_menu_c"><input class="input fooddiary_div_menu_1" value="" type="time"></p><p class="fooddiary_menu_right"><input class="input fooddiary_div_menu_2" value=""></p></div>');
	}
}