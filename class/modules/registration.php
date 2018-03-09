<?php
	class registration extends module{
		
		public $name='Вход',$module='registration',$link='/registration',$background='';
		
		public function registration(){
			$this->init();
		}
		
		public function in_ok(){
			$model=new registration_model();
			$view=new registration_view();
			$this->html=$view->in_ok($model->in_ok($this->data_post));
		}
	}
?>