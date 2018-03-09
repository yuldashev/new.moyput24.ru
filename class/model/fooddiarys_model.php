<?php
	class fooddiarys_model extends model{
		
		public function content_fooddiarys($data,$read=0){
			$fooddiarys=new fooddiary();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$fooddiary=$fooddiarys->getfooddiary($days->data,$GLOBALS['user']->user->id,$read); // Получаем выбранный день
				
				$this->data['title']='Дневник питания'; // Выводим причину
				$this->data['error']='0';
				$this->data['data']=$this->get_d($fooddiary->day).' '.$this->month_rus($fooddiary->day);
				$this->data['day']=$days->data['day'];
				$this->data['idnum']=$data['get']['id'];
				$this->data['result']=$fooddiary; // Формируем ответ и передаем управление view
				$this->data['par']=$GLOBALS['user']->user->par;
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Дневник питания недоступен'; // Выводим причину
			}
			return $this->data;
		}
		
		public function fooddiary_save($data){
			$fooddiarys=new fooddiary();
			
			if ($fooddiarys->savefooddiary($data)) {
				if ($data['post']['type']=='button_1') { 
					$this->data['title']='Сохранил'; 
				} else { 
					$this->data['title']='Отчет дня отправил';
					$days=new days();
					$this->data['setread']=$days->setread($data['post']['idnum']);
				} // Выводим результат (заголовок)
				$this->data['result']='Изменения в дневнике питания сохранены'; // Выводим результат
				$this->data['error']='0';
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['title']='Ошибка';
				$this->data['result']='Не удалось сохранить'; // Выводим причину
			}
			return $this->data;
		}
		
		public function world_fooddiarys(){
			$fooddiarys=new fooddiary();
			
			$fooddiary=$fooddiarys->world_fooddiarys();
			
			if ($fooddiary['result']) {
				$this->data['title']='Мир Дневников питания: Ученик Ольги Анчиной'; // Выводим причину
				$this->data['error']='0';
				$this->data['data']=$this->get_d($fooddiary['dnevnik']->day).' '.$this->month_rus($fooddiary['dnevnik']->day);
				foreach($fooddiary['user']->days as $data => $value){
					if ($data==$fooddiary['dnevnik']->day) {
						$this->data['day']=$value['day'];
					}
				}
//				$this->data['idnum']=$data['get']['id'];
				$this->data['result']=$fooddiary['dnevnik']; // Формируем ответ и передаем управление view
				$this->data['user']=$fooddiary['user']; // Передача данных клиента
				$this->data['par']=$fooddiary['par'];
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['title']='Ошибка';
				$this->data['result']='Заполните анкету'; // Выводим причину				
			}
			return $this->data;
		}
		
		public function new_comments(){ // Новые комментарии
			$fooddiary=new fooddiary();
			$fooddiarys=$fooddiary->getfooddiary_new_comment($GLOBALS['user']->user->id);
			$result=array();
			foreach($GLOBALS['user']->user->days as $date => $value){
				for($j=0;$j<$fooddiarys->count;$j++){
					if ($date==$fooddiarys->rows[$j]->day) {
						$inday='';
						for($i=0;$i<count($value['constr']);$i++){
							if ($value['constr'][$i]['type']=='Дневник питания') {
								$inday=$value['constr'][$i]['id'];
							}
						}
						$result[]=array($value['day'],$inday);
					}
				}
			}
			
			$fooddiarys=$fooddiary->getfooddiary_old_comment($GLOBALS['user']->user->id);
			$result_old=array();
			foreach($GLOBALS['user']->user->days as $date => $value){
				for($j=0;$j<$fooddiarys->count;$j++){
					if ($date==$fooddiarys->rows[$j]->day) {
						$inday='';
						for($i=0;$i<count($value['constr']);$i++){
							if ($value['constr'][$i]['type']=='Дневник питания') {
								$inday=$value['constr'][$i]['id'];
							}
						}
						$result_old[]=array($value['day'],$inday);
					}
				}
			}			
			
			return array($result,$result_old);
		}
		
		public function countnewcomments(){ // Новые комментарии
			$fooddiary=new fooddiary();
			$fooddiarys=$fooddiary->getfooddiary_new_comment($GLOBALS['user']->user->id);
			return $fooddiarys->count;
		}
		
	}
?>