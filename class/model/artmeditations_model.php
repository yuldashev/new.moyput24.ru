<?php
	class artmeditations_model extends model{
		
		public function content_artmeditations($data){
			$artmeditations=new artmeditation();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$artmeditation=$artmeditations->getartmeditation($data['get']['id']);
				
				if ($artmeditation['error']) {
					$this->data['error']='1'; // Ошибка есть
					$this->data['result']=$artmeditation['result']; // Выводим причину
				} else {
					$this->data['error']='0'; // Ошибки нет
					$this->data['result']=$artmeditation['result']; // Выводим причину
					$this->data['idnum']=$data['get']['id'];
				}
				
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Артмедитация недоступна'; // Выводим причину
			}
			return $this->data;
		}
		
		public function artmeditation_save($data){
			$days=new days();
			if ($days->test_rules($data['post']['id'])) {
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