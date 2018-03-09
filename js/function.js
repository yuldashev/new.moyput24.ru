$(function(){
	$('input').live('keydown',function(eventObject){
		$(this).attr({"autocomplete":"off"});
		if (eventObject.keyCode==13) {
			if (typeof $(this).data("action") != "undefined") {
				$("#"+$(this).data("action")).click();
			}
		}
	});
	
	if ($("#menuIcon").length) {
		$("#menuIcon,#menuIcon_psevdo").click(function(){
			document.location.href = '/menu/';
		});
		
		$(".user_info_menu_ico").hover(
			function(){ $("#user_info_menu").stop().toggle(500); },
			function(){}
		);
		
		$("#user_info_menu").hover(
			function(){},
			function(){ $("#user_info_menu").stop().toggle(500); }
		);
	}
	
	if ($("#system_info").text()!='') {
		$("#system_info").toggle(500);
	}
	
	$(".link").live("click",function(){
		if ((typeof $(this).data("link") != "undefined")&&($(this).data("link")!='')) {
			document.location.href = $(this).data("link");
		}
	});
	
	$(".ajax").live("click",function(){
		if ((typeof $(this).data("ajax") != "undefined")&&($(this).data("ajax")!='')) {
			var data={};
			if (typeof $(this).data("post") != "undefined") { data=$(this).data("post"); }
			auto_ajax($(this).data("ajax"),data);
		}
	});
	
	$(".text").live("click",function(){
		if ((typeof $(this).data("text") != "undefined")&&($(this).data("text")!='')) {
			auto_ajax('/lk/text/',{'text':$(this).data("text")});
		}
	});
	
	$(".menu_top_li").hover(
		function(){ $(".menu_top_li").stop().animate({'opacity':'0.2'},500); $(this).stop().animate({'opacity':'1'},500); },
		function(){ $(".menu_top_li").stop().animate({'opacity':'1'},500); }
	);
	
	$(".menu_li").hover(
		function(){ if ($(window).width()>1100) { $(".menu_li").stop().animate({'opacity':'0.2'},500); $(this).stop().animate({'opacity':'1'},500); } },
		function(){ if ($(window).width()>1100) { $(".menu_li").stop().animate({'opacity':'1'},500); } }
	);
	
	$(".spark").hover(
		function(){ $(".spark").stop().animate({'opacity':'0.5'},500); $(this).stop().animate({'opacity':'1'},500); },
		function(){ $(".spark").stop().animate({'opacity':'1'},500); }
	);
	
	$(".text_formated iframe[src*=\"youtube.com\"]").each(function(){
		$(this).css({"width":$(this).parent().width()+"px","height":(337/600)*$(this).parent().width()+"px"});
	});
	
	$(".text_formated img").each(function(){ if ($(this).width()>100) { $(this).parent().css({"display":"inline"}); } });
	
	if ($("#new_avatar").length) {
		init_uploads('new_avatar','/lk/downloads_photo/');
	}
	
	if ($("#my_password").length) 
	{
		$("#my_password").click(function(){
			create_shadow("Восстановление пароля","Для того, чтобы вспомнить пароль напишите слово ДОСТУП в закрытой группе нашей школы <a href='http://vk.me/moyputschool' target='_blank' style='color:#cc0000;'>http://vk.me/moyputschool</a>","500");
		});
	}
});

function go($url,$sleep){
	if (typeof $sleep == "undefined") { var $sleep=3000; }
	setTimeout(function(){ document.location.href = $url; },$sleep);
}

function auto_ajax(url,data,loading){
	if (typeof loading == "undefined") { loading_start(); }
	$.ajax({
		url: url,
		type: 'POST',
		data: data,
		success: function(html){
			$('body').append(delBr(html));
			if (typeof loading == "undefined") { loading_close(); }
		}
	});
}

function create_shadow($title,$html,$w,$nowidth){
	if(typeof $w == "undefined") { var $w='500'; }
	if ($('html').width()<$w) { $w=$('html').width()-40; }
	var $w_title=$w-40,$w_input=$w-14-4-40;
	if ($('.shadow').length==0) { $("#body").css({'filter':'blur(2px)'}); }
	$('body').append('<div class="shadow"><div class="shadow_close" onclick="close_shadow();"></div><div class="shadow_panel" style="width:'+$w+'px;"><span class="shadow_button_close" onclick="close_shadow();">×</span><div class="shadow_panel_vn"><div class="shadow_title">'+$title+'</div><div class="shadow_html">'+str_replace('<br />','\n',str_replace('<br /> ','\n',$html))+'</div></div></div></div><div class="clear"></div>');
	if ((typeof $nowidth != "undefined")&&($nowidth == "auto")) { 
		$('.shadow input').css({'width':$w_input+'px'});
		$('.shadow textarea').css({'width':($w_input+2)+'px'}); 
		$('.shadow select').css({'width':($w_input+18)+'px'}); 
	}
	$('.shadow').animate({'opacity':'1'},500);
	$('.shadow_button_close,.order_q').hover(
		function(){ $(this).animate({'opacity':'0.6'},300); },
		function(){ $(this).animate({'opacity':'0.2'},300); }
	);
}

function close_shadow(){
  var l=$('.shadow').length;
  $('.shadow').eq(l-1).animate({'opacity':'0'},500,function(){ $('.shadow').eq(l-1).remove(); if ($('.shadow').length==0) { $("#body").css({'filter':'blur(0px)'}); } });
}

function loading_start(){
	$("body").append("<div class='shadow shadow_loading' style='opacity:1;'><img src='images/loading.gif' class='shadow_loading'></div>");
	$("#body").css({'filter':'blur(2px)'});
}

function loading_close(){
	$('.shadow_loading').remove(); 
	if ($('.shadow').length==0) { $("#body").css({'filter':'blur(0px)'}); }
}

function create_array(data){
	var array=[];
	for (var i = 0; i < data.length; i++) {
		array[i]=[];
		$(data[i]).each(function(){ array[i][array[i].length]=$(this).val(); });
	}
	return array;
}

function required(data){
	var data_error={'title':'Внимание!','body':'Необходимо заполнить'};
	for (var i = 0; i < data.length; i++) {
		if ($(data[i]).val()=="") { 
			if (typeof $(data[i]).data('error_title') != "undefined") { 
				data_error['title']=$(data[i]).data('error_title'); 
			} else { 
				data_error['title']='Внимание!'; 
			} 
			if (typeof $(data[i]).data('error_body') != "undefined") { 
				data_error['body']=$(data[i]).data('error_body'); 
			} else { 
				data_error['body']='Необходимо заполнить'; 
			} 
			info_generate(data_error['title'],data_error['body'],data[i],'error'); 
			return false;
		}
	}
	return true;
}

function info_generate(title,body,id,type){
	$(".message").remove();
	if (id!='') {
		$("#body").append('<div id="info_for_'+$(id).attr('id')+'" class="'+type+' message" style="top:'+($(id).offset().top-(48-$(id).outerHeight())/2)+'px;left:'+($(id).offset().left+$(id).outerWidth()+5)+'px;"><a class="close" title="Закрыть" href="#" onClick="document.getElementById(\'info_for_'+$(id).attr('id')+'\').setAttribute(\'style\',\'display: none;\'); return false;">&times;</a><span>'+title+'</span> '+body+'</div>');
		if ($("#info_for_"+$(id).attr('id')).offset().left+$("#info_for_"+$(id).attr('id')).outerWidth() > $('html').width()) { $("#info_for_"+$(id).attr('id')).css({'top':($(id).offset().top-$("#info_for_"+$(id).attr('id')).height()+5)+'px','left':$(id).offset().left+'px'}); }
		
		if ($('html, body').scrollTop()>$('#info_for_'+$(id).attr('id')).offset().top-10) { $('html, body').animate({ scrollTop: $('#info_for_'+$(id).attr('id')).offset().top-10 }, 500); }
		
		$("input,textarea").keyup(function(){ $("#info_for_"+$(id).attr('id')).remove(); });
	} else {
		$("#body").append('<div id="info_for_system" class="'+type+' message" style="top:5px;right:5px; position:fixed;"><a class="close" title="Закрыть" href="#" onClick="document.getElementById(\'info_for_system\').setAttribute(\'style\',\'display: none;\'); return false;">&times;</a><span>'+title+'</span> '+body+'</div>');
		setTimeout(function(){ $("#info_for_system").remove(); },3000);
	}
}

function delBr (s) { return s.replace (/[\n\r]/g, ' ').replace (/\s{2,}/g, ' '); }

function init_uploads($id,$uploader){
	$('#'+$id).after('<form id="upload-form-'+$id+'" method="post" enctype="multipart/form-data"><input type="hidden" name="test-value-from-form" value="test" /><div id="fortest-'+$id+'"><input type="file" class="form-control auto-tip" id="file-input-'+$id+'" name="my-file" /></div></form>');
	$('#'+$id).click(function(){ $("#file-input-"+$id).click(); });
	$('#upload-form-'+$id).css({"height": "0px","overflow": "hidden","display":"none"});
	upload_start($uploader,$id);
}

function upload_start($url,$id){
			
			var $fileInput = $('#file-input-'+$id);
			var $dropBox = $('#drop-box-'+$id);
			var $uploadForm = $('#upload-form-'+$id);
			var $uploadRows = $('#upload-rows-'+$id);
			var autostartOn = true;
			var previewsOn = true;

			///// Uploader init
			$fileInput.damnUploader({
				// URL of server-side upload handler
				url: $url,
				// File POST field name (for ex., it will be used as key in $_FILES array, if you using PHP)
				fieldName:  'my-file',
				// Container for handling drag&drops (not required)
				dropBox: $dropBox,
				// Limiting queued files count (if not defined [or false] - queue will be unlimited)
				limit: 5,
				// Expected response type ('text' or 'json')
				dataType: 'json'
			});


			///// Misc funcs

			var isTextFile = function(file) {
				return file.type == 'text/plain';
			};

			var isImgFile = function(file) {
				return file.type.match(/image.*/);
			};


			// Creates queue table row with file information and upload status
			var createRowFromUploadItem = function(ui) {
				var $progressBar;
				
				return $progressBar;
			};

			// File adding handler
			var fileAddHandler = function(e) {
				// e.uploadItem represents uploader task as special object,
				// that allows us to define complete & progress callbacks as well as some another parameters
				// for every single upload
				var ui = e.uploadItem;
				var filename = ui.file.name || ""; // Filename property may be absent when adding custom data

				// We can call preventDefault() method of event to cancel adding
				/*if (!isTextFile(ui.file) && !isImgFile(ui.file)) {
					log(filename + ": is not image. Only images & plain text files accepted!");
					e.preventDefault();
					return ;
				}*/

				// We can replace original filename if needed
				if (!filename.length) {
					ui.replaceName = "custom-data";
				} else if (filename.length > 140) {
					ui.replaceName = filename.substr(0, 100) + "_" + filename.substr(filename.lastIndexOf('.'));
				}

				// We can add some data to POST in upload request
				ui.addPostData($uploadForm.serializeArray()); // from array
				ui.addPostData('original-filename', filename); // .. or as field/value pair

				// Show info and response when upload completed
				var $progressBar = createRowFromUploadItem(ui);
				ui.completeCallback = function(success, data, errorCode) {
					log('******');
					log((this.file.name || "[custom-data]") + " completed");
					if (success) {
						log('recieved data:', data);
					} else {
						log('uploading failed. Response code is:', errorCode);
					}
				};

				// Updating progress bar value in progress callback
				ui.progressCallback = function(percent) {
					$progressBar.css('width', Math.round(percent) + '%');
				};

				// To start uploading immediately as soon as added
				autostartOn && ui.upload();
			};


			///// Setting up events handlers

			// Uploader events
			$fileInput.on({
				'du.add' : fileAddHandler,

				'du.limit' : function() {
					log("File upload limit exceeded!");
				},

				'du.completed' : function() {
					log('******');
					log("All uploads completed!");
				}
			});

			// Form submit
			$uploadForm.on('submit', function(e) {
				// Sending files by HTML5 File API if available, else - form will be submitted on fallback handler
				if ($.support.fileSending) {
					e.preventDefault();
					$fileInput.duStart();
				}
			});
			
}

function str_replace(search, replace, subject) {
	return subject.split(search).join(replace);
}