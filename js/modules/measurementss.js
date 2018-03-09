$(function(){
	$('#button_2').click(function(){
		if (!required(["#newpar_0","#newpar_1","#newpar_2"])) {
			return false;
		}
		auto_ajax('/measurementss/measurements_save/',{'newpar_0':$('#newpar_0').val(),'newpar_1':$('#newpar_1').val(),'newpar_2':$('#newpar_2').val(),'id':$(this).data('id'),'idnum':$(this).data('idnum')});
	});
	

	$(".photo").hover(
		function(){ $(".photo").stop().animate({'opacity':'0.5'},500); $(this).stop().animate({'opacity':'1'},500); },
		function(){ $(".photo").stop().animate({'opacity':'1'},500); }
	);
	
	for(var $i=0;$i<3;$i++){
		init_uploads('photo_'+$i,'/measurementss/downloads_photo/'+$('#photo_'+$i).data('id')+'/'+$i+'/');
	}
})