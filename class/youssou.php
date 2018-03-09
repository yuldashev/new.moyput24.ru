<?php
	class youssou{ // Класс видеовопросов
		
		function face($id){
			$youssou=$this->getyoussou($id);
			return array('title'=>$youssou->name,'ico'=>'ico_videovopros.jpg');
		}
		
		function getyoussou($id){
			$db=new db();
			$db->select('videoq','inday',array($id)); 
			if ($db->count>0) {
				return array('error'=>'0','result'=>$db->rows[0]);
			} else {
				return array('error'=>'1','result'=>'Видеовопрос не найден');
			}
		}
		
		function get_answer($id,$user){
			$db=new db();
			
			$db->select('videootvet','id_videoq,user',array($id,$user)); 
			if ($db->count>0) {
				return $db->rows[0];
			}
		}
		
		public function saveyoussou($data,$user){ // Сохранение ответа на видеовопрос
			$db=new db();
			
			if ($db->insert('videootvet','user,id_videoq,otvet',array($user,$data['post']['id'],$data['post']['answer']))) {
				return true;
			} else {
				return false;
			}
			
		}
		
	}
?>