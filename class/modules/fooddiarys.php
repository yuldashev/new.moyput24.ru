<?php
	class fooddiarys extends module{
		
		public $name='Дневник питания',$module='fooddiarys',$link='/fooddiarys',$background='background.jpg';
		
		public function fooddiarys(){
			$this->init();
		}
		
		public function content(){
			
			$model=new fooddiarys_model();
			$view=new fooddiarys_view();
			
			if ($this->data_get['id']) {
				$this->html=$view->content_fooddiarys($model->content_fooddiarys($this->data)); // Получение и вывод дневника питания
			}
		}
		
		public function fooddiary_save(){
			
			$model=new fooddiarys_model();
			$view=new fooddiarys_view();
			
			$this->html=$view->fooddiary_save($model->fooddiary_save($this->data)); // Сохранение изменений в дневнике
		}
	}
?>