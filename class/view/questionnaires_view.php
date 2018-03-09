<?php
	class questionnaires_view extends view{
		
		public function content($data){
			$this->html='<h2>Анкета</h2>
			<div class="left" style="width:50%; float:left;">
				<p><small>Вы можете изменить свой логин и пароль</small></p>
				<input class="input" placeholder="Логин*" title="Логин" id="edit_1" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->login.'"><br>
				<input class="input" placeholder="Пароль*" title="Пароль" id="edit_2"  style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->password.'"><br><br>
				<input class="input" placeholder="Город*" title="Город" id="edit_3" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->city.'"><br>
				<input class="input" placeholder="Фамилия*" title="Фамилия" id="edit_4" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->client[0].'"><br>
				<input class="input" placeholder="Имя*" title="Имя" id="edit_5" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->client[1].'"><br>
				<input type="hidden" class="input" placeholder="Отчество" title="Отчество" id="edit_6" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->client[2].'"><br>
				<input class="input" placeholder="Возраст*" title="Возраст" id="edit_7" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->par[0].'"> лет<br>
				<input class="input" placeholder="Рост*" title="Рост" id="edit_8" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->par[6].'"> см<br><br>
				<input '.($GLOBALS['user']->user->link!=''?'type="hidden"':'').' class="input" placeholder="Страница ВК. Напр: http://vk.com/id123456789*" title="Страница ВК" id="edit_9" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->link.'">
				<input type="hidden" class="input" placeholder="E-mail*" title="E-mail" id="edit_10" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->email.'">
				<input type="hidden" class="input" placeholder="Телефон*" title="Телефон" id="edit_11" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->tel.'">
				
				<input class="input" placeholder="Текущий вес*" title="Текущий вес" id="edit_12" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->par[1].'"> кг<br>
				<input class="input" placeholder="Желаемый вес через 2 месяца*" title="Желаемый вес" id="edit_13" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->par[2].'"> кг<br><br>
				
				<input class="input" placeholder="Обхват груди*" title="Обхват груди" id="edit_14" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->par[3].'"> см<br>
				<input class="input" placeholder="Обхват талии*" title="Обхват талии" id="edit_15" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->par[4].'"> см<br>
				<input class="input" placeholder="Обхват бедер*" title="Обхват бедер" id="edit_16" style="margin:5px 0;width:80%;" value="'.$GLOBALS['user']->user->par[5].'"> см<br><br>
			</div>
			<div class="right" style="text-align:center;width:50%; float:left;">
				<small>Перед измерением посмотрите видео</small><br>
				<b><small>Как правильно измерить обхват</small></b>
				<div style="height:220px;"><center>
					<iframe width="364" height="205" src="https://www.youtube.com/embed/tmnqLqZ5PYQ?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen id="v1" style="display:none;"></iframe><iframe width="364" height="205" src="https://www.youtube.com/embed/In4AxFhRxPI?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen id="v2" style="display:none;"></iframe><iframe width="364" height="205" src="https://www.youtube.com/embed/ep-8jrv7lvQ?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen id="v3"></iframe></center>
				</div>
				&nbsp;<button onclick="$(\'#v2,#v1\').css({\'display\':\'none\'});$(\'#v3\').css({\'display\':\'block\'});" class="button_green" style=\'width:100px;\'>Грудь</button>&nbsp;&nbsp;<button onclick="$(\'#v2,#v3\').css({\'display\':\'none\'});$(\'#v1\').css({\'display\':\'block\'});" class="button_green" style=\'width:100px;\'>Талия</button>&nbsp;&nbsp;<button onclick="$(\'#v1,#v3\').css({\'display\':\'none\'});$(\'#v2\').css({\'display\':\'block\'});" class="button_green" style=\'width:100px;\'>Бедра</button>&nbsp;
			</div>
			<div class="clear"></div>
			<textarea id="edit_17" title="Цель курса" placeholder="Цель курса. Например: Похудеть и поправить свое здоровье / Похудеть до 76 кг" class="input" style="width: calc(100% - 22px); width: -moz-calc(100% - 22px); width: -webkit-calc(100% - 22px); width: -o-calc(100% - 22px); height:100px; display:none;">'.$GLOBALS['user']->user->cel.'</textarea>
			
			<button class="button_green" style="width:100%;" id="questionnaire_save">Сохранить</button>';

			return $this->html;
		}
		
		public function questionnaires_save($data){
			$this->html=$this->standart_message($data);
			if ($data['error']==0) { $this->html.='<script>go("/lk/","3000");</script>'; }
			return $this->html;
		}
		
	}
?>