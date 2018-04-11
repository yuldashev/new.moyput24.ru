<?php
	class partner extends module{
		
		public $name='Партнерская программа',$module='partner',$link='/partner',$background='background.jpg';
		
		public function partner(){
			$this->init();
		}
		
		public function content(){
			$model=new partner_model();
			$view=new partner_view();
			
			$this->html=$view->content($model->content()); 
		}
		
		public function new_partner(){
			$model=new partner_model();
			$view=new partner_view();
			
			$this->html=$view->new_partner($model->new_partner($this->data)); 
		}
		
	}
?>