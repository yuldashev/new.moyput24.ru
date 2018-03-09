<?php
	class chat{ // Класс Чата
		
		function get_messages($id){
			$db=new db();
			$db->select('chat','user',array($id),'id'); 
			return $db;
		}
		
		function add_messages($data){
			$db=new db();
			return $db->insert('chat','user,crm,type,stage,body',array($GLOBALS['user']->user->id,$GLOBALS['user']->user->crm,'1','0',$data['post']['message']));
		}
		
		function chat_new_comment($id){
			$db=new db();
			$db->select('chat','user,type,stage',array($id,'0','0')); 
			return $db;
		}
	}
?>