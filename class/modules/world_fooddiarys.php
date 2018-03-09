<?php
	class world_fooddiarys extends module{
		
		public $name='Мир Дневников питания',$module='world_fooddiarys',$link='/world_fooddiarys',$background='background.jpg';
		
		public function world_fooddiarys(){
			$this->init();
		}
		
		public function content(){
			
			$model=new fooddiarys_model();
			$view=new fooddiarys_view();
			
			$this->html=$view->content_fooddiarys($model->world_fooddiarys($this->data)); // Получение и вывод дневника питания
			
		}
	}
?>