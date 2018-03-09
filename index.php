<?php
	$start = microtime(true);
	require_once('config.php');
	
	$init = new init(); // Инициализация всего неинициализированного
	$user = new user(); // Получение информации о вошедшем
	$globals = new globals(); // Получение глобальных настроек системы
	$language = new language(); // Инициализация языка
	$module = new post_get("module","1"); // Получение имени модуля
	$method = new post_get('method'); // Получение имени метода
	
	if ((!$user->authorization)&&($method->res()=='')) { // На странице своей системы если не авторизован - то авторизуется пущай
		$tpl = new template('registration');
		$tpl -> out();
	} else {
		if (($method->res()=='')||($method->res()==$module->res())) { // Если авторизован, то отправляем на страницу модуля при отсутствии запроса к отдельному методу
			$tpl = new template('lk');
			$tpl -> out();
		} else { // Если авторизован, то отправляем на страницу метода
			header('Content-Type: text/html; charset=utf-8');
			$module_name = $module->res();
			$methods = $method->res();
			$modules = new $module_name();
			$result=$modules->$methods();
			echo $modules -> out();
		}		
	}

	echo '<script> console.log("Время выполнения скрипта: '.(microtime(true) - $start).' сек."); </script>';
?>