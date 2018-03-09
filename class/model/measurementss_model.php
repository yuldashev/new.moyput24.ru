<?php
	class measurementss_model extends model{
		
		public function content_measurementss($data){
			$measurementss=new measurements();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$measurements=$measurementss->getmeasurements($days->data,$GLOBALS['user']->user->id); // Получаем выбранный день
				
				$this->data['title']='Замеры'; // Выводим причину
				$this->data['error']='0';
				$this->data['data']=$this->get_d($measurements->day).' '.$this->month_rus($measurements->day);
				$this->data['day']=$days->data['day'];
				$this->data['idnum']=$data['get']['id'];
				$this->data['result']=$measurements; // Формируем ответ и передаем управление view
				
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Замеры недоступны'; // Выводим причину
			}
			return $this->data;
		}
		
		public function get_measurementss_photo($data){
			$measurementss=new measurements();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$measurements=$measurementss->get_measurements_photo($days->data['day'],$GLOBALS['user']->user->id); // Получаем фотографии выбранного дня
				
				$this->data['title']='Фотографии'; // Выводим заголовок
				$this->data['error']='0';
				$this->data['data']=$this->get_d($days->data['data']).' '.$this->month_rus($days->data['data']).' - '.$this->get_d($this->data_add($days->data['data'],7)).' '.$this->month_rus($this->data_add($days->data['data'],7));
				$this->data['week']=$this->get_week($days->data['day']);
				$this->data['day']=$days->data['day'];
				$this->data['idnum']=$data['get']['id'];
				$this->data['result']=$measurements; // Формируем ответ и передаем управление view
				
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Фотографии недоступны'; // Выводим причину
			}
			return $this->data;
		}
		
		public function measurements_save($data){
			$measurementss=new measurements();
			if ($measurementss->savemeasurementss($data)) {
				
				$this->data['title']='Сохранил';
				$days=new days();
				$this->data['setread']=$days->setread($data['post']['idnum']);
				
				$this->data['result']='Изменения в замерах сохранены'; // Выводим результат
				$this->data['error']='0';
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['title']='Ошибка';
				$this->data['result']='Не удалось сохранить'; // Выводим причину
			}
			return $this->data;
		}
		
		public function downloads_photo($data){
			$downloads = new download();
			$downloads -> simple();
			
			if (!$downloads->result['download']) {
				$this->data['error']='1'; // Ошибка есть
				$this->data['title']='Ошибка.';
				$this->data['result']='Не удалось загрузить файл'; // Выводим причину
			} else {
				$this->save_image($downloads->result['pathname'],array(array('url'=>'photo/'.$GLOBALS['user']->user->id."_".$data["get"]["key"]."_".$data["get"]["id"].'.jpg','w'=>'201','h'=>'201'),array('url'=>'photo/big_'.$GLOBALS['user']->user->id."_".$data["get"]["key"]."_".$data["get"]["id"].'.jpg','w'=>'600','h'=>'')));
				$this->data['error']='0'; // Ошибки нет
				$this->data['title']='Успешно.'; //Заголовок
				$this->data['result']='Фото загружено'; // Выводим причину
				$this->data['url']='photo/'.$GLOBALS['user']->user->id."_".$data["get"]["key"]."_".$data["get"]["id"].'.jpg?key='.time();
				$this->data['id']=$data["get"]["key"];
			}
			return $this->data;
		} 
		
	}
?>