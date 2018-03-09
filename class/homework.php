<?php
	class homework extends standard{ // Класс домашнего задания
		
		function face($id){
			$homework=$this->gethomework($id);
			return array('title'=>$homework->name,'ico'=>'ico_domz.jpg');
		}
		
		function gethomework($id){
			$db=new db();
			$db->select('domz','inday',array($id)); 
			if ($db->count>0) {
				return array('error'=>'0','result'=>$db->rows[0]);
			} else {
				return array('error'=>'1','result'=>'Домашнее задание не найдено');
			}
		}
		
		function get_answer($id,$user){
			$db=new db();
			
			$db->select('dzresult','dz,user',array($id,$user)); 
			if ($db->count>0) {
				return $db->rows[0];
			}
		}
		
		public function savehomework($data,$user){ // Сохранение ответа на домашнее задание
			
			if ($this->insert_update('dzresult','user,dz',array($user,$data['post']['id']),'user,dz,text',array($user,$data['post']['id'],$data['post']['answer']))) {
				return true;
			} else {
				return false;
			}
			
		}
	}
?>