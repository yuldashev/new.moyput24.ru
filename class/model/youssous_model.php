<?php
	class youssous_model extends model{
		
		public function content_youssous($data){
			$youssous=new youssou();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$youssou=$youssous->getyoussou($data['get']['id']);
				
				if (!$youssou['error']) {
					$this->data['error']='0'; // Ошибки нет
					$this->data['result']=$youssou['result']; // Выводим причину
					
					$this->data['idnum']=$data['get']['id'];
					$this->data['answer']=$youssous->get_answer($youssou['result']->id,$GLOBALS['user']->user->id);
				} else {
					$this->data['error']='1'; // Ошибки нет
					$this->data['result']=$youssou['result']; // Выводим причину
				}
				//вытащить текущий ответ клиента
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Видеовопрос недоступен'; // Выводим причину
			}
			return $this->data;
		}
		
		public function youssou_save($data){
			$youssou=new youssou();
			if ($youssou->saveyoussou($data,$GLOBALS['user']->user->id)) {
				$this->data['title']='Сохранил'; // Выводим результат (заголовок)
				$days=new days();
				$this->data['setread']=$days->setread($data['post']['idnum']);
				
				$this->data['result']='Задание выполнено'; // Выводим результат
				$this->data['error']='0';
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['title']='Ошибка';
				$this->data['result']='Не удалось сохранить'; // Выводим причину
			}
			return $this->data;
		}
	}
?>