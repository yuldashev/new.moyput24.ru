<?php
	class config{
		public function config(){ // Настройки сервера
			set_time_limit(60);
			ini_set('display_errors','Off');
		}
		
		public function db(){ // Настройки базы данных
			define('dbhost','localhost');
			define('dbname','js');
			define('dbuser','js');
			define('dbpass','tb9n19PX2J3A1');			
		}
		
		public function url(){ // Текущий УРЛ, получение префикса таблиц БД
			$url=$_SERVER['SERVER_NAME'];
			define('base_url','http://'.$url.'/');
			define('base_domain',$url);
			define('salt','2017');
			$array_url=explode('.',$url);
			define('pre','reg_');
			
			/*define('api_id','6255089');
			define('secret_key','LQpvSjIUwNCKDec8FQsN');
			define('access_token','a220d5d9a220d5d9a220d5d9dca27fa428aa220a220d5d9f8267210dade1447ea4a0ee9');*/
			
			define('api_id','4318640');
			define('secret_key','bR4B8eHgW10gioGZKB59');
			define('access_token','ed7094b59d8056ac6e5980d95b39687bdc0f5f89ee4f9621e2ddd3d6f21e59f462f630d5b5d31143a8a3f');
		}
	}
	
	function __autoload($class_name) {
		if (file_exists('class/'.$class_name.'.php')) { 
			include 'class/'.$class_name.'.php'; 
		} elseif (file_exists('class/modules/'.$class_name.'.php')) { 
			include 'class/modules/'.$class_name.'.php'; 
		} elseif (file_exists('class/model/'.$class_name.'.php')) { 
			include 'class/model/'.$class_name.'.php'; 
		} elseif (file_exists('class/view/'.$class_name.'.php')) { 
			include 'class/view/'.$class_name.'.php'; 
		} else { 
			echo "404 - ".$class_name; 
			exit; 
		}
	}
	
	$config=new config();
	$config->db();
	$config->url();
?>