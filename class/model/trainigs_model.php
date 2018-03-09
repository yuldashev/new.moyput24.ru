<?php
	class trainigs_model extends model{
		
		public function content_trainigs($data){
			$trainigs=new trainig();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$trainig=$trainigs->gettrainig($data['get']['id']);
				
				if ($trainig['error']) {
					$this->data['error']='1'; // Ошибка есть
					$this->data['result']=$trainig['result']; // Выводим причину
				} else {
					$this->data['error']='0'; // Ошибки нет
					$this->data['result']=array('title'=>'Тренировка '.$days->data['day'].' дня','body'=>$trainig['result']); // Выводим причину
					$this->data['inday']=$data['get']['id'];
				}
				
				//$this->data['setread']=$days->setread($data['get']['id']);
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Тренировка недоступна'; // Выводим причину
			}
			return $this->data;
		}
	}
?>