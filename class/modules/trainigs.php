<?php
	class trainigs extends module{
		
		public $name='Тренировки',$module='trainigs',$link='/trainigs',$background='background.jpg';
		
		public function trainigs(){
			$this->init();
		}
		
		public function content(){
			
			$model=new trainigs_model();
			$view=new trainigs_view();
			
			if ($this->data_get['id']) {
				$this->html=$view->content_trainigs($model->content_trainigs($this->data)); // Получение и вывод тренировки
			}
		}
	}
?>