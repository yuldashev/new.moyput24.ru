<?php
	class fooddiarys_view extends view{
	
		public function content_fooddiarys($data){
			if ($data['error']) {
				$this->html='<h2>'.$data['result'].'</h2>';
			} else {
				$this->html='<h2>'.$data['title'].'</h2>';
				$this->html.='<div class="fooddiary_div_margin"><p class="fooddiary_head_left">'.$data['data'].'</p><p class="fooddiary_head_right">'.$data['day'].' день</p></div>';
				$this->html.='<div class="fooddiary_div_padding" style="background:#f5f5f5;"><p class="fooddiary_head_left">Вес до начала: '.$data['par'][1].' кг</p><p class="fooddiary_head_right">Цель: похудеть до '.$data['par'][2].' кг</p></div>';
				$this->html.='<div class="fooddiary_div_padding">Вес на утро: <input class="input" value="'.$data['result']->ves_1.'" style="width:100px; margin: auto 20px auto 70px;" id="ves_1" data-error_title="Вес на утро." data-error_body="Необходимо указать."> кг</div>';
				$this->html.='<div class="line"></div>';
				
				$this->html.='<div id="fooddiary_menu">';
				$this->html.='<div class="fooddiary_div_menu" style="margin-top:15px;"><p class="fooddiary_menu_left fooddiary_menu_left_first">&nbsp;&nbsp;&nbsp;Укажите прием пищи</p><p class="fooddiary_menu_left fooddiary_menu_left_next">&nbsp;&nbsp;&nbsp;Прием пищи</p><p class="fooddiary_menu_c">&nbsp;&nbsp;&nbsp;Время</p><p class="fooddiary_menu_right">&nbsp;&nbsp;&nbsp;Что ела</p></div>';
				
				for($i=0;$i<count($data['result']->pitanie)+1;$i++){
					$this->html.='<div class="fooddiary_div_menu" style="margin-top:15px;"><p class="fooddiary_menu_left">';
					
					$this->html.='<select class="input fooddiary_div_menu_0">'.$this->create_option(array(array('Завтрак','Завтрак'),array('Обед','Обед'),array('Ужин','Ужин'),array('Перекус','Перекус')),$data['result']->pitanie[$i][0]).'</select>';
					
					$this->html.='</p><p class="fooddiary_menu_c"><input class="input fooddiary_div_menu_1" value="'.$this->time_formated($data['result']->pitanie[$i][1]).'" type="time" data-value="'.$data['result']->pitanie[$i][1].'"></p><p class="fooddiary_menu_right"><input class="input fooddiary_div_menu_2" value="'.$data['result']->pitanie[$i][2].'"></p></div>';
				}
				
				$this->html.='</div>';
				
				$this->html.='<div class="line"></div>';
				$this->html.='<div class="fooddiary_div_padding">Вес перед сном: <input class="input" value="'.$data['result']->ves_2.'" style="width:100px; margin: auto 20px auto 40px;" id="ves_2" data-error_title="Вес перед сном." data-error_body="Необходимо указать."> кг</div>';
				$this->html.='<div class="line"></div>';
				
				$this->html.='<div class="fooddiary_div_padding"><b>Вывод дня и самочувствие, вопросы по питанию и методике: </b></div><div id="comment_head"><textarea id="comment" class="input" data-error_title="Вывод дня." data-error_body="Пожалуйста, заполните." placeholder="Вывод дня. Пожалуйста, заполните.">'.stripslashes($data['result']->comment).'</textarea></div>';
				
				if (trim($data['result']->otvet)!='') {
					$this->html.='<div class="fooddiary_div_padding"><b>Комментарий куратора: </b></div><div id="otvet_head"><textarea id="otvet" class="input" data-error_title="Комментарий куратора." data-error_body="Комментарий куратора." placeholder="Комментарий куратора.">'.$data['result']->otvet.'</textarea></div>';
				}
				
				$this->html.='<div style="text-align:right; margin:15px 0;"><button class="button_white" style="width:200px; margin-right:20px;" id="button_1" data-id="'.$data['result']->id.'" data-idnum="'.$data['idnum'].'">Сохранить</button><button class="button_green" style="width:200px;" id="button_2" data-id="'.$data['result']->id.'" data-idnum="'.$data['idnum'].'">Отправить отчет дня</button></div>';
				
				$this->html.='<div style="text-align:right; margin:15px 0; display:none;"><button class="button_green" style="width:200px;" id="button_3">Показать еще</button></div>';
			}
			return $this->html;
		}
		
		public function world_fooddiarys($data){
			return $this->standart_message($data);
		}
		
		public function fooddiary_save($data){
			return $this->standart_message($data);
		}
		
		public function new_comments($data){
			$this->html='<div><h2>Новые комментарии</h2>';
			for($i=0;$i<count($data[0]);$i++){
				$this->html.='<button class="button_white link" style="width:150px; margin-right:20px; border:1px solid #8fcf0d;" data-link="/fooddiaryscomments/fooddiaryscomments/'.$data[0][$i][1].'/">'.$data[0][$i][0].' день</button>';
			}
			$this->html.='</div>';
			$this->html.='<div><h2>Старые комментарии</h2>';
			for($i=0;$i<count($data[1]);$i++){
				$this->html.='<button class="button_white link" style="width:150px; margin-right:20px; border:1px solid #8fcf0d;" data-link="/fooddiaryscomments/fooddiaryscomments/'.$data[1][$i][1].'/">'.$data[1][$i][0].' день</button>';
			}
			$this->html.='</div>';
			return $this->html;
		}
		
		public function countnewcomments($data){
			if ($data>0) { return '<span>'.$data.'</span><script>$(function(){ $("#new_fooddiaryscomments").css({"display":"inline-block"}); })</script>'; } else { return ''; }
		}
	}
?>