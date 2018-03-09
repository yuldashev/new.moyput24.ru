<?php
	class videos extends module{
		
		public $name='Видео',$module='videos',$link='/videos',$background='background.jpg';
		
		public function videos(){
			$this->init();
		}
		
		public function content(){
			
			$model=new videos_model();
			$view=new videos_view();
			$model_result=$model->content($this->data);
			
			if ($model_result->count>1) { $this->html=$view->content($model_result); } else { $this->html=$view->content_single($model_result); }
			
		}
		
	}
?>