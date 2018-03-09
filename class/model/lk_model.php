<?php
	class lk_model extends model{
		
		public function info_ok($data){ // Функция начала нового дня
			$time=time();
			if ((($GLOBALS['user']->user->days[date('Y-m-d',$time)]['day']=='')&&($GLOBALS['user']->user->level=='1'))||(($GLOBALS['user']->user->days_l2[date('Y-m-d',$time)]['day']=='')&&($GLOBALS['user']->user->level=='2'))) { // Выполняется, если день начат не был
				$days=new days();
				$days_create_control=$days->days_create_control($GLOBALS['user']->user->id); // Проверяем, можно ли начать новый день
				if (!$days_create_control['result']) { // Новый день начать нельзя
					$this->data['error']='1'; // Ошибка есть
					$this->data['result']=$days_create_control['comment']; // Выводим причину
				} else {
					$days_create=$days->days_create($GLOBALS['user']->user->id); // Начинаем новый день
					$this->data['error']='0'; // Ошибки нет
					$this->data['result']=$days_create['comment']; // Выводим отчет
				}
			}
			return $this->data;
		}
		
		public function content_lk($data){ // Вывод списка заданий дня
			$time=time();
			
			if (!$data['get']['key']) {
				$day_show=$GLOBALS['user']->user->days[date('Y-m-d',$time)]['day']; // Выводим либо последний день (текущий)
			} else {
				$day_show=$data['get']['key']; // Либо выбранный
			}
			
			$days=new days();
			$day=$days->get_day($day_show);
			
			if (!$day['result']) { // Если не нашли нужный день
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']=$day['comment']; // Выводим причину
			} else {
				$this->data['error']='0'; // Ошибки нет
				$this->data['data']=$day['data']; // Дата прохождения дня
				$this->data['day']=$day['day']['day']; // Номер дня
				for($i=0;$i<count($day['day']['constr']);$i++){
					$work=array();
					$work['id']=$day['day']['constr'][$i]['id'];
					$work['read']=$day['day']['constr'][$i]['read'];
					$work['srok']=$day['day']['constr'][$i]['srok'];
					$work['type']=$day['day']['constr'][$i]['type'];

					switch ($work['type']) // Определяем тип задания и подключаем соответствующий класс
					{
						case 'Тренировка': $class = "trainig"; break;
						case 'Дневник питания': $class = "fooddiary"; break;
						case 'Статья': $class = "article"; break;
						case 'Замеры': $class = "measurements"; break;
						case 'Видеовопрос': $class = "youssou"; break;
						case 'Арт-медитация': $class = "artmeditation"; break;
						case 'Домашнее задание': $class = "homework"; break;
					}
					
					$workclass = new $class();
					$work['class'] = $class.'s';
					$work['face'] = $workclass->face($work['id']);
					$this->data['work'][] = $work; // Сохраняем обложку данного класса и заголовок при наличии
				}
			}
			return $this->data;
		}
		
		public function downloads_photo($data){
			$downloads = new download();
			$downloads -> simple();
			
			if (!$downloads->result['download']) {
				$this->data['error']='1'; // Ошибка есть
				$this->data['title']='Ошибка.';
				$this->data['result']='Не удалось загрузить файл'; // Выводим причину
			} else {
				$this->save_image($downloads->result['pathname'],array(array('url'=>'photo/'.$GLOBALS['user']->user->id.'.jpg','w'=>'68','h'=>'68')));
				$this->data['error']='0'; // Ошибки нет
				$this->data['title']='Успешно.'; //Заголовок
				$this->data['result']='Фото загружено'; // Выводим причину
				$this->data['url']='photo/'.$GLOBALS['user']->user->id.'.jpg?key='.time();
				$this->data['id']=$data["get"]["id"];
			}
			return $this->data;
		} 
		
		public function get_top(){
			$info=new info();
			return array_merge($info->get_info(),$info->get_calendar(),$info->get_bunner());
		}
		
		public function setread($data){
			$days=new days();
			if ($days->test_rules($data['post']['idnum'])) {
				$this->data['error']='0'; // Ошибки нет
				$this->data['result']='Выполнил'; // Выводим причину
				$this->data['setread']=$days->setread($data['post']['idnum']);
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Ошибка'; // Выводим причину
			}
			return $this->data;
		}
		
	}
?>