<?php
	class info{ // Класс статей
		
		function get_info(){
			$db=new db();
			
			if ($GLOBALS['user']->user->crm>0) { 
				$db->select_free('SELECT * FROM `'.pre.'info` WHERE `start`<? AND `finish`>? AND (`crm`=? OR `crm`=?)',array(time(),time(),$GLOBALS['user']->user->crm,'0'));
			} else { 
				$db->select_free('SELECT * FROM `'.pre.'info` WHERE `start`<? AND `finish`>? AND `crm`=?',array(time(),time(),'0')); 
			}
			
			$result=array();
			
			for ($i=0;$i<$db->count;$i++) {
				$result[]=preg_replace('/[\r\n]+(?![^(]*\))/', "",$db->rows[$i]->body);
			}
			
			return $result;
		}
		
		function get_calendar(){
			$db=new db();
			
			$result=array();
			
			if ($GLOBALS['user']->user->crm>0) { 
				$db->select_free('SELECT * FROM `'.pre.'calendar` WHERE `day`=? AND `user`=? AND (`type`=? OR `type`=?)',array(mktime('0','0','0',date('m'),date('d'),date('Y')),$GLOBALS['user']->user->crm,'0','1')); 
			}
			
			$month=array();
			$month[]="";
			$month[]="Января";
			$month[]="Февраля";
			$month[]="Марта";
			$month[]="Апреля";
			$month[]="Мая";
			$month[]="Июня";
			$month[]="Июля";
			$month[]="Августа";
			$month[]="Сентября";
			$month[]="Октября";
			$month[]="Ноября";
			$month[]="Декабря";
			
			for ($i=0;$i<$db->count;$i++) {
				$result[]=preg_replace('/[\r\n]+(?![^(]*\))/', "",'Дорогие ученицы! Сегодня, '.date('d').' '.$month[(date('m')+0)].', у Вашего куратора выходной.');
			}
			
			return $result;
			
		}
		
		function get_bunner(){
			$db=new db();
			
			$result=array();
			
			$db->select_free('SELECT * FROM `'.pre.'vebinar_bunner` WHERE 1',array());
			
			for ($i=0;$i<$db->count;$i++) {
				if ((strtotime($db->rows[$i]->date_1.' '.$db->rows[$i]->time_1)<(time()+9559))&&(strtotime($db->rows[$i]->date_2.' '.$db->rows[$i]->time_2)>(time()+9559))) {
					$result[]=$db->rows[$i]->text;
				}
			}
			
			return $result;
			
		}
		
	}
?>