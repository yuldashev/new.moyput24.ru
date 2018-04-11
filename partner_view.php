<?php
	class partner_view extends view{
	
		public function content($data){
			if (!$data[0]) {
				$this->html='<button class="button_green" id="new_partner">Хочу стать партнером МойПуть</button>';
				$this->html.='<script>$(function(){ $("#new_partner").click(function(){ auto_ajax("/partner/new_partner/",{}); }); })</script>';
			} else {
				$this->html='<div>Ваша партнерская ссылка: <b>http://new.moyput24.ru/partner.php?partner='.$GLOBALS['user']->user->id.'</b></div>';
				
				$this->html.='<div>Переходов по Вашей ссылке: <b>'.($data[2][0]+0).'</b></div>';
				$this->html.='<div>Регистраций по Вашей ссылке: <b>'.($data[2][1]+0).'</b></div>';
				
			}
			
			return $this->html;
		}
		
		public function new_partner($data){
			return '<script>$(function(){ go("/partner/","0"); })</script>';
		}	
		
	}
?>