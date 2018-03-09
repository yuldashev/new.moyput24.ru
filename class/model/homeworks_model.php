<?php
	class homeworks_model extends model{
		
		public function content_homeworks($data){
			$homeworks=new homework();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$homework=$homeworks->gethomework($data['get']['id']);
				
				if (!$homework['error']) {
					$this->data['error']='0'; // Ошибки нет
					$this->data['result']=$homework['result']; // Выводим причину
					
					$this->data['idnum']=$data['get']['id'];
					$this->data['answer']=$homeworks->get_answer($homework['result']->id,$GLOBALS['user']->user->id);
				} else {
					$this->data['error']='1'; // Ошибки нет
					$this->data['result']=$homework['result']; // Выводим причину
				}
				//вытащить текущий ответ клиента
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Видеовопрос недоступен'; // Выводим причину
			}
			return $this->data;
		}
		
		public function homework_save($data){
			$homework=new homework();
			if ($homework->savehomework($data,$GLOBALS['user']->user->id)) {
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