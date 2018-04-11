<?php
	class chats_model extends model{
		
		public function content(){
			$chat=new chat();
			return $chat->get_messages($GLOBALS['user']->user->id);
		}
		
		public function new_chat_message($data){
			$chat=new chat();
			return $chat->add_messages($data);
		}
		
		public function countnewcomments(){ // Новые комментарии
			$chat=new chat();
			$chats=$chat->chat_new_comment($GLOBALS['user']->user->id);
			return $chats->count;
		}
		
	}
?>