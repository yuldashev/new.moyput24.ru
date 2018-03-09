<?php
	class chats extends module{
		
		public $name='Чат',$module='chats',$link='/chats',$background='background.jpg';
		
		public function chats(){
			$this->init();
		}
		
		public function content(){
			$model=new chats_model();
			$view=new chats_view();
			
			$this->html=$view->content($model->content()); 
		}
		
		public function new_chat_message(){
			$model=new chats_model();
			$view=new chats_view();
			
			$this->html=$view->new_chat_message($model->new_chat_message($this->data)); 
		}
		
		public function countnewcomments(){
			$model=new chats_model();
			$view=new chats_view();
			
			$this->html=$view->countnewcomments($model->countnewcomments($this->data));
		}
	}
?>