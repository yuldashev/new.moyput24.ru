<?php
	class fooddiaryscomments extends module{
		
		public $name='Дневник питания',$module='fooddiaryscomments',$link='/fooddiaryscomments',$background='background.jpg';
		
		public function fooddiaryscomments(){
			$this->init();
		}
		
		public function content(){
			
			$model=new fooddiarys_model();
			$view=new fooddiarys_view();
			
			$this->html=$view->new_comments($model->new_comments($this->data)); // Получение списка новых комментариев
			
			if ($this->data_get['id']) {
				
				$this->html.=$view->content_fooddiarys($model->content_fooddiarys($this->data,$read='1')); // Получение и вывод дневника питания
			}
		}
		
		public function countnewcomments(){
			$model=new fooddiarys_model();
			$view=new fooddiarys_view();
			
			$this->html=$view->countnewcomments($model->countnewcomments($this->data));
		}
		
		public function uniquejs(){
			$this->html='<script type="text/javascript" src="js/modules/world_fooddiarys.js"></script> ';
			
			$this->html.='<link href="css/modules/world_fooddiarys.css" type="text/css" rel="stylesheet" />';
		}
	}
?>