<?php
	class vebinars extends module{
		
		public $name='Вебинары',$module='vebinars',$link='/vebinars',$background='background.jpg';
		
		public function vebinars(){
			$this->init();
		}
		
		public function content(){
			
			$model=new vebinars_model();
			$view=new vebinars_view();
			$model_result=$model->content($this->data);
			
			if ($model_result->count>1) { $this->html=$view->content($model_result); } else { $this->html=$view->content_single($model_result); }
			
		}
		
	}
?>