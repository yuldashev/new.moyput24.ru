<?php
	class videos_model extends model{
		
		public function content($data){ // Вывод видео
			$db=new db();
			if ($data['get']['id']>0) {
				$db->select('videos','id',array($data['get']['id']));
			} else {
				$db->select('videos','',array(),'id');
			}
			return $db;
		}
		
	}
?>