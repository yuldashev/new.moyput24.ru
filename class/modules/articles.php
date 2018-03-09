<?php
	class articles extends module{
		
		public $name='Статьи',$module='articles',$link='/articles',$background='background.jpg';
		
		public function articles(){
			$this->init();
		}
		
		public function content(){
			
			$model=new articles_model();
			$view=new articles_view();
			
			if ($this->data_get['id']) {
				$this->html=$view->content_articles($model->content_articles($this->data)); // Получение и вывод содержимого статьи
			}
		}
	}
?>