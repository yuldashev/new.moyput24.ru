<?php
	class artmeditation{ // Класс артмедитаций
		
		function face($id){
			$artmeditation=$this->getartmeditation($id);
			return array('title'=>$artmeditation->name,'ico'=>'ico_art_m.jpg');
		}
		
		function getartmeditation($id){
			$db=new db();
			$db->select('artm','inday',array($id)); 
			if ($db->count>0) {
				return array('error'=>'0','result'=>$db->rows[0]);
			} else {
				return array('error'=>'1','result'=>'Арт-медитация не найдена');
			}
		}
		
	}
?>