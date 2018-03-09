<?php
	class tutor{ // Класс куратор
	
		function get_weekend($tutor,$data){ // Проверка, есть ли у куратора выходной в конкретную дату
			$db=new db();
			$unix_newt_day=strtotime($data)+24*60*60;
			$unix_newt_day_f=strtotime($data)+2*24*60*60;
			//$db->select('calendar','user,day,type',array($tutor,$unix_newt_day,'1'),'`id` DESC','1');
			$db->select_free('SELECT `id` FROM `'.pre.'calendar` WHERE `user`=? AND `day`>=? AND `day`<? AND `type`=?',array($tutor,$unix_newt_day,$unix_newt_day_f,'1'));
			if ($db->count>0) {
				return true;
			} else {
				return false;
			}
		}
	
	}
?>