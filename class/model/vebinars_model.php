<?php
	class vebinars_model extends model{
		
		public function content($data){ // Вывод вебинаров
			$db=new db();
			if ($data['get']['id']>0) {
				$db->select('vebinars','id',array($data['get']['id']));
			} else {
				$db->select_free('SELECT v.*,u.user FROM reg_vebinars as v LEFT JOIN reg_user_vebinars as u ON (v.id=u.vebinar AND u.user='.$GLOBALS['user']->user->id.') WHERE 1 ORDER by v.id',array());
			}
			return $db;
		}
		
	}
?>