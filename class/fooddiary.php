<?php
	class fooddiary extends standard{ // Класс дненвика питания
		
		function face($id){
			return array('title'=>'','ico'=>'ico_dnevnik_pitaniya.jpg');
		}
		
		function getfooddiary($data,$user,$read=0){ // Выводим день дневника питания
			$db=new db();
			
			if ($read) { $db->update('dnevnik','read_otvet','day,user',array('1',$data['data'],$user)); }
			
			$db->select('dnevnik','day,user',array($data['data'],$user),'`id` DESC','1');
			if (($db->count==0)&&($user==$GLOBALS['user']->user->id)) {
				$db=$this->create_new_fooddiary($data); // Если еще не начинали, то начинаем
			}
			$db->rows[0]->pitanie=$this->unserialize($db->rows[0]->pitanie); // Выполняем десериализацию
			
			return $db->rows[0]; // Передаем информацию о дне
		}
		
		function getfooddiaryuser($user){ // Получаем все дневники питания клиента
			$db=new db();
			
			$db->select('dnevnik','user',array($user),'`id`');
			
			return $db; // Передаем информацию о дневниках
		}
		
		function getfooddiary_new_comment($user){ // Получаем все дневники питания клиента
			$db=new db();
			
			$db->select_free('SELECT * FROM `'.pre.'dnevnik` WHERE `user`=? AND `otvet`!=? AND `otvet` IS NOT NULL AND `read_otvet`=?',array($user,'','0'));
			
			return $db; // Передаем информацию о дневниках
		}
		
		function getfooddiary_old_comment($user){ // Получаем все дневники питания клиента
			$db=new db();
			
			$db->select_free('SELECT * FROM `'.pre.'dnevnik` WHERE `user`=? AND `otvet`!=? AND `otvet` IS NOT NULL AND `read_otvet`!=?',array($user,'','0'));
			
			return $db; // Передаем информацию о дневниках
		}
		
		function create_new_fooddiary($data){ // Создам новый день дневника питания
			$db=new db();
			$tutor=new tutor();
			if (($GLOBALS['user']->user->crm>0)&&($tutor->get_weekend($GLOBALS['user']->user->crm,$data['data']))) {								  // Определяем тип дневника
				if (count($GLOBALS['user']->user->days)<5) {	// Нашли выходной у куратора
					$db_c='1';									// Первого типа
				} else {
					$db_c='2';									// Второго типа
				}
			} else {
				$db_c='0';										// Дня самоконтроля нет
			}
			
			if ($db->insert('dnevnik','day,user,db_c',array($data['data'],$GLOBALS['user']->user->id,$db_c))) { // Создаем новый пустой день
			
				$array=array();
				$db->select_free('SELECT `id` FROM `'.pre.'dnevnik` WHERE `user`=? ORDER by `id`',array($GLOBALS['user']->user->id));
				for($i=0;$i<$db->count;$i++){
					$array[]=$db->rows[$i]->id;
				}
				$db->update('users','dnevnik','id',array(serialize($array),$GLOBALS['user']->user->id)); // Сохраняем массив дневников, которые принадлежат данному клиенту
				
				$db->select_free('SELECT * FROM `'.pre.'dnevnik` WHERE `user`=? ORDER by `id` DESC LIMIT 1',array($GLOBALS['user']->user->id));
				
				return $db;
			} else {
				return false;
			}
			
		}
		
		public function savefooddiary($data){ // Сохранение изменений в дневнике
			$db=new db();
			$db->select('dnevnik','id,user',array($data['post']['id'],$GLOBALS['user']->user->id),'`id` DESC','1');
			
			$pitanie=array();
			for($i=0;$i<count($data['post']['menu']);$i++){
				for($j=0;$j<count($data['post']['menu'][$i]);$j++){
					if ($data['post']['menu'][2][$j]!='') { $pitanie[$j][$i]=$data['post']['menu'][$i][$j]; }
				}
			}
			
			if ($data['post']['type']=='button_1') { 
				$stage=$db->rows[0]->stage; 
			} else { 
				$stage='2'; 
			}
			
			if ($db->update('dnevnik','ves_1,ves_2,comment,pitanie,stage','id,user',array($data['post']['ves_1'],$data['post']['ves_2'],$data['post']['comment'],serialize($pitanie),$stage,$data['post']['id'],$GLOBALS['user']->user->id))) {
				return true;
			} else {
				return false;
			}
			
		}
		
		function world_fooddiarys(){
			$db=new db();
			$db_help=new db();
			
			if (($GLOBALS['user']->user->count_md<5)||($GLOBALS['user']->user->city!='')||($GLOBALS['user']->user->token=='')) {
				
				$db->update('users','count_md','id',array(($GLOBALS['user']->user->count_md+1),$GLOBALS['user']->user->id));
				
				$db->select_free('SELECT `id` FROM `'.pre.'dnevnik` WHERE 1 ORDER BY `id` DESC LIMIT 1',array());
				
				$db->select_free('SELECT * FROM `'.pre.'dnevnik` WHERE `otvet`<>? AND `stage`=? AND LENGTH(`otvet`)>? AND LENGTH(`comment`)>? AND `show`=? AND `id`>? AND `db_c`!=? ORDER BY RAND() LIMIT 1',array('','2','100','100','1',($db->rows[0]->id-1000),'2'));
				$db_help->select('users','id',array($db->rows[0]->user)); // Чей дневник
				
				$db_help->rows[0]->client=$this->unserialize($db_help->rows[0]->client);
				$db_help->rows[0]->days=$this->unserialize($db_help->rows[0]->days);
				$client=$db_help->rows[0]->client;
				
				$db->rows[0]->pitanie=$this->unserialize($db->rows[0]->pitanie); // Выполняем десериализацию
				$db->rows[0]->otvet=preg_replace('/[\r\n]+(?![^(]*\))/', "\\n", str_replace(array("'",'"'),'',str_replace(array($client[0],$client[1]),'*****',$db->rows[0]->otvet)));
				
				return array('result'=>true,'user'=>$db_help->rows[0],'dnevnik'=>$db->rows[0],'par'=>$this->unserialize($db_help->rows[0]->par));
			} else {
				return array('result'=>false);
			}
		}
		
	}
?>