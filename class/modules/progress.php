<?php
	class progress extends module{
		
		public $name='Прогресс',$module='progress',$link='/progress',$background='background.jpg';
		
		public function progress(){
			$this->init();
		}
		
		public function content(){
			
			$model=new progress_model();
			$view=new progress_view();
				
			$this->html=$view->get_progress_photo($model->get_progress_photo($this->data)); // Получение и вывод фотографий до/после
			
			$this->html.=$view->get_progress_graph($model->get_progress_graph($this->data)); // Получение и вывод графика
			
			$this->html.=$view->get_progress_table($model->get_progress_table($this->data)); // Получение и вывод таблицы
		}
		
		public function downloads_photo(){
			$model=new progress_model();
			$view=new progress_view();
			$this->html=$view->downloads_photo($model->downloads_photo($this->data));
		}
		
		public function uniquejs(){
			$this->html='<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
		}
		
	}
?>