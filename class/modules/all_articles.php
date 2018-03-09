<?php
	class all_articles extends module{
		
		public $name='Все статьи',$module='all_articles',$link='/all_articles',$background='background.jpg';
		
		public function all_articles(){
			$this->init();
		}
		
		public function content(){
			
			$model=new articles_model();
			$view=new articles_view();
			
			$this->html=$view->all_articles($model->all_articles()); // Получение и вывод списка доступных статей
			
		}
	}
?>