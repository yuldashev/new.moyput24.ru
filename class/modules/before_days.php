<?php
	class before_days extends module{
		
		public $name='Предыдущие дни',$module='before_days',$link='/before_days',$background='background.jpg';
		
		public function before_days(){
			$this->init();
		}
		
		public function content(){
			$model=new before_days_model();
			$view=new before_days_view();
			
			$this->html=$view->content($model->content($this->data)); // Вывод информации
			
		}
		
	}
?>