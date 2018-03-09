<?php
	class measurements extends standard{ // Класс замеров
		
		function face($id){
			return array('title'=>'','ico'=>'ico_zamer.jpg');
		}
		
		function getmeasurements($data,$user){ // Выводим дневник за день замеров
			$db=new db();
			
			$db->select('dnevnik','day,user',array($data['data'],$user),'`id` DESC','1');
			if (($db->count==0)&&($user==$GLOBALS['user']->user->id)) {
				$fooddiarys=new fooddiary();
				$db=$fooddiarys->create_new_fooddiary($data); // Если еще не начинали, то начинаем
			}
			$db->rows[0]->newpar=$this->unserialize($db->rows[0]->newpar); // Выполняем десериализацию
			
			return $db->rows[0]; // Передаем информацию о дне
		}
		
		function get_measurements_photo($data,$user){ // Выводим дневник за день замеров
			$result=array();
			for($i=0;$i<3;$i++){
				if (file_exists('photo/'.$user.'_'.$i.'_'.$data.'.jpg')) {
					$result[]=array('photo/'.$user.'_'.$i.'_'.$data.'.jpg?key='.time(),getimagesize('photo/'.$user.'_'.$i.'_'.$data.'.jpg'));
				} else {
					$result[]=array('images/no-image.jpg',getimagesize('images/no-image.jpg'));
				}
			}
			return $result;
		}
		
		public function savemeasurementss($data){ // Сохранение изменений в замерах
			$db=new db();
			
			$newpar=array($data['post']['newpar_0'],$data['post']['newpar_1'],$data['post']['newpar_2']);
			
			if ($db->update('dnevnik','newpar','id,user',array(serialize($newpar),$data['post']['id'],$GLOBALS['user']->user->id))) {
				return true;
			} else {
				return false;
			}
			
		}
		
	}
?>