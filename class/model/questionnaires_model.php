<?php
	class questionnaires_model extends model{
		
		public function content(){ 
			
		}
		
		public function questionnaires_save($data){
			$questionnaire=new questionnaire();
			
			if ($questionnaire->questionnaire_save($data)) {
				$this->data['title']='Сохранил';
				$this->data['result']='Изменения в анкете сохранены';
				$this->data['error']='0';				
			} else {
				$this->data['title']='Ошибка';
				$this->data['result']='Попробуйте снова';
				$this->data['error']='1';				

			}
				
			return $this->data;
			
		}
	
	}
?>