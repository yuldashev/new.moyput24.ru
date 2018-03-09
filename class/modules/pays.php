<?php
	class pays extends module{
		
		public $name='Оплата',$module='pays',$link='/pays',$background='background.jpg';
		
		public function pays(){
			$this->init();
		}
		
		public function content(){
			$model=new pays_model();
			$view=new pays_view();
			$this->html=$view->content($model->content());
		}
		
	}
?>