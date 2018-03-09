<?php
	class questionnaires extends module{
		
		public $name='Анкета',$module='questionnaires',$link='/questionnaires',$background='background.jpg';
		
		public function questionnaires(){
			$this->init();
		}
		
		public function content(){
			
			$model=new questionnaires_model();
			$view=new questionnaires_view();
			
			$this->html=$view->content($model->content());
			
		}
		
		public function questionnaires_save(){
			$model=new questionnaires_model();
			$view=new questionnaires_view();
			
			$this->html=$view->questionnaires_save($model->questionnaires_save($this->data));
		}
		
	}
?>