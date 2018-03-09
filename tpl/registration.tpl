<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{title}</title>
<base href="{base_url}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="{favicon}" type="image/png">
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/class.css" type="text/css" rel="stylesheet" />
{class_registration_css}
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="js/function.js"></script> 
{class_registration_js}
</head>
<body style="height:100%;">
	<div id="body" style="height:100%;">
		<div id="registration_body">
			<img src="images/int.png">
			<div>
				<input id="input_registration_1" type="text" placeholder="Логин*" class="center" data-action="registration_ok">
				<input id="input_registration_2" type="text" placeholder="Пароль*" class="center" data-action="registration_ok">
				<p id="my_password_help" style="color:#cc0000; display:none; margin-bottom:20px; text-align:center; overflow:visible;">Вы ввели неверный логин/пароль. <br><span style="cursor:pointer; border-bottom:1px solid #cc0000; overflow:visible;" onclick="$('#my_password').click();">Сделать напоминание.</span></p>
			</div>
			<div class="clear"></div>
			<center>
				<button class="button_green" id="registration_ok">Войти</button>
				<p id="my_password" style="text-align:center; margin-top:20px; overflow:visible;"><span style="font-size:16px; overflow:visible;">Напомнить пароль</span></p>
			</center>
		</div>
	</div>
</body>
</html>