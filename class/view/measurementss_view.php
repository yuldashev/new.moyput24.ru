<?php
	class measurementss_view extends view{
	
		public function content_measurementss($data){
			if ($data['error']) {
				$this->html='<h2>'.$data['result'].'</h2>';
			} else {
				$this->html='<h2>'.$data['title'].'</h2>';
				$this->html.='<div class="measurements_div_margin"><p class="measurements_head_left">'.$data['data'].'</p><p class="measurements_head_right">'.$data['day'].' день</p></div>';
				$this->html.='<div class="measurements_div_padding" style="background:#f5f5f5;"><p class="measurements_head_left">Вес до начала: '.$GLOBALS['user']->user->par[1].' кг</p><p class="measurements_head_right">Цель: похудеть до '.$GLOBALS['user']->user->par[2].' кг</p></div>';
				$this->html.='<div class="measurements_div_padding">Грудь: <input class="input" value="'.$data['result']->newpar[0].'" style="width:100px; margin: auto 20px auto 75px;" id="newpar_0" data-error_title="Замеры. Грудь. " data-error_body="Необходимо указать." placeholder=""> см</div>';
				$this->html.='<div class="measurements_div_padding">Талия: <input class="input" value="'.$data['result']->newpar[1].'" style="width:100px; margin: auto 20px auto 72px;" id="newpar_1" data-error_title="Замеры. Талия. " data-error_body="Необходимо указать." placeholder=""> см</div>';
				$this->html.='<div class="measurements_div_padding">Бедра: <input class="input" value="'.$data['result']->newpar[2].'" style="width:100px; margin: auto 20px auto 70px;" id="newpar_2" data-error_title="Замеры. Бедра. " data-error_body="Необходимо указать." placeholder=""> см</div>';
				
				
				$this->html.='<div style="text-align:right; margin:15px 0;"><button class="button_green" style="width:200px;" id="button_2" data-id="'.$data['result']->id.'" data-idnum="'.$data['idnum'].'">Сохранить</button></div>';
			}
			return $this->html;
		}
	
		public function get_measurementss_photo($data){
			$this->html='<div class="line"></div>';
			if ($data['error']) {
				$this->html.='<h2>'.$data['result'].'</h2>';
			} else {
				$this->html.='<h2>'.$data['title'].'</h2>';
				$this->html.='<div class="measurements_div_margin"><p class="measurements_head_left">'.$data['data'].'</p><p class="measurements_head_right">'.$data['week'].' неделя</p></div>';
				
				$this->html.='<center>';
				$type_photo=array('Фото спереди','Фото сбоку','Фото сзади');
				for ($i=0;$i<3;$i++) {
					$this->html.='<div class="download photo" id="photo_'.$i.'" data-id="'.$data['day'].'"><div class="photo_conteiner"><div class="photo_div"><img src="'.$data['result'][$i][0].'" id="my_photo_'.$i.'"></div><div class="photo_div_comment">'.$type_photo[$i].'</div></div><img src="images/download.png" class="photo_download"></div>';
				}
				$this->html.='</center>';
			}
			return $this->html;
		}
		
		public function downloads_photo($data){
			$this->html=$this->standart_message($data);
			$this->html.='<script>$(function(){ $("#my_photo_'.$data['id'].'").attr({"src":"'.$data['url'].'"}); })</script>';
			return $this->html;
		}
		
		public function measurements_save($data){
			return $this->standart_message($data);
		}
		
	}
?>