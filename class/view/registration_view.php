<?php
	class registration_view extends view{
		
		public function in_ok($data){
			if ($data['error']=='1') {
				$this->html='<script>$("#input_registration_1,#input_registration_2").addClass("red"); $("#my_password_help").toggle(500); setTimeout(function(){ $("#input_registration_1,#input_registration_2").removeClass("red"); $("#my_password_help").toggle(500); },5000);</script>';
			} else {
				$this->html='<script>$("#registration_body").html("<h1>Успешная авторизация</h1><h2 style=\"margin:20px 0; text-align:center;\">Сейчас Вы будете перенаправлены в Ваш личный кабинет</h2><button class=\"button_green\"><a href=\"http://'.base_domain.'/lk\">'.base_domain.'/lk</a></button>"); setTimeout(function(){ window.location.href = "http://'.base_domain.'/lk"; },3000);</script>';
			}
			return $this->html;
		}
		
	}
?>