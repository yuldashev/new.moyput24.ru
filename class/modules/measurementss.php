<?php
	class measurementss extends module{
		
		public $name='Замеры и фото',$module='measurementss',$link='/measurementss',$background='background.jpg';
		
		public function measurementss(){
			$this->init();
		}
		
		public function content(){
			
			$model=new measurementss_model();
			$view=new measurementss_view();
			
			if ($this->data_get['id']) {
				$this->html=$view->content_measurementss($model->content_measurementss($this->data)); // Получение и вывод замеров
				
				$this->html.=$view->get_measurementss_photo($model->get_measurementss_photo($this->data)); // Получение и вывод еженедельных фото
			}
		}
		
		public function downloads_photo(){
			$model=new measurementss_model();
			$view=new measurementss_view();
			$this->html=$view->downloads_photo($model->downloads_photo($this->data));
		}
		
		public function measurements_save(){
			$model=new measurementss_model();
			$view=new measurementss_view();
			
			$this->html=$view->measurements_save($model->measurements_save($this->data)); // Сохранение изменений в замерах
		}
	}
?>