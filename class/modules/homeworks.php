<?php
	class homeworks extends module{
		
		public $name='Домашнее задание',$module='homeworks',$link='/homeworks',$background='background.jpg';
		
		public function homeworks(){
			$this->init();
		}
		
		public function content(){
			
			$model=new homeworks_model();
			$view=new homeworks_view();
			
			$this->html=$view->content_homeworks($model->content_homeworks($this->data)); // Получение и вывод домашнего задания
		}
		
		public function homework_save(){
			
			$model=new homeworks_model();
			$view=new homeworks_view();
			
			$this->html=$view->homework_save($model->homework_save($this->data)); // Сохранение изменений в домашнем задании
		}
	}
?>