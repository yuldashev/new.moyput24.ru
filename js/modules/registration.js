$(function(){
	$("#registration_ok").click(function(){ 
		if (required(["#input_registration_1","#input_registration_2"])) {
			auto_ajax("/registration/in_ok/",{login:$("#input_registration_1").val(),password:$("#input_registration_2").val()}); 
		}
	});
})