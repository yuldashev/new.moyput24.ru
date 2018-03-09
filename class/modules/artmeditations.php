<?php
	class artmeditations extends module{
		
		public $name='Арт-медитации',$module='artmeditations',$link='/artmeditations',$background='background.jpg';
		
		public function artmeditations(){
			$this->init();
		}
		
		public function content(){
			
			$model=new artmeditations_model();
			$view=new artmeditations_view();
			
			if ($this->data_get['id']) {
				$this->html=$view->content_artmeditations($model->content_artmeditations($this->data)); // Получение и вывод содержимого арт-медитации
			}
			
		}
		
		public function artmeditation_save(){
			
			$model=new artmeditations_model();
			$view=new artmeditations_view();
			
			$this->html=$view->artmeditation_save($model->artmeditation_save($this->data)); // Сохранение изменений в арт-медитации
		}
	}
?>