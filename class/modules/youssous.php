<?php
	class youssous extends module{
		
		public $name='Видеовопрос',$module='youssous',$link='/youssous',$background='background.jpg';
		
		public function youssous(){
			$this->init();
		}
		
		public function content(){
			
			$model=new youssous_model();
			$view=new youssous_view();
			
			$this->html=$view->content_youssous($model->content_youssous($this->data)); // Получение и вывод содержимого видеовопроса
		}
		
		public function youssou_save(){
			
			$model=new youssous_model();
			$view=new youssous_view();
			
			$this->html=$view->youssou_save($model->youssou_save($this->data)); // Сохранение изменений в видеовопросе
		}
	}
?>