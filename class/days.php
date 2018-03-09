<?php
	/*
		Класс, выполняющий системные операции: запуск нового дня для ученика, вывод информации об учебном дне, проверяющий, доступно ли ученику задание, меняющий статус выполненности
	*/
	class days{
		
		public $data=array();
		
		public function days(){}
		
		public function days_create_control($id='1'){ //Проверка, можем ли начать новый день для ученика (Проверка оплаты, нет ли бана, есть ли ответы на видеовопросы, есть ли этот ученик)
			$db=new db();
			$db->select_free('SELECT `days`,`days_l2`,`banned`,`stage` FROM `'.pre.'users` WHERE `id`=? LIMIT 1',array($id));
			if ($db->count==0) {
				return array('result'=>'0','key'=>'0','comment'=>'Ученик не найден'); // Существует ли такой ученик
			}
			if ($db->rows[0]->banned=='1') {
				return array('result'=>'0','key'=>'1','comment'=>'Ученик заблокирован'); // Не заблокирован ли ученик
			}
			if (($db->rows[0]->stage=='-2')||($db->rows[0]->stage=='-1')||($db->rows[0]->stage=='0')||($db->rows[0]->stage=='11')) {
				return array('result'=>'0','key'=>'2','comment'=>'Доступ ограничен, обратитесь к куратору'); // Проверяем стадию
			}
			
			$days=unserialize($db->rows[0]->days);
			$days_l2=unserialize($db->rows[0]->days_l2);
			
			if (($days[date('Y-m-d',$time)]['day']!='')||($days_l2[date('Y-m-d',$time)]['day']!='')) {
				return array('result'=>'0','key'=>'3','comment'=>'День начат ранее'); // Проверяем ответы на видеовопросы нулевого дня
			}
			
			if ((count($days)==0)||(!is_array($days))) {
				$db->select_free('SELECT `id` FROM `'.pre.'inday` WHERE `day`=? AND `type`=?',array('0','Видеовопрос'));
				$count_vq_0=$db->count;
				
				$db->select_free('SELECT DISTINCT `id_videoq` FROM `'.pre.'videootvet` WHERE `user`=? ORDER by `id`',array($id));
				$count_vq_1=$db->count;
				
				$db->select_free('SELECT `id`,`time_create` FROM `'.pre.'videootvet` WHERE `user`=? ORDER by `id`',array($id));
				
				if (($db->count==0)||(($count_vq_0>=$count_vq_1)&&(strpos(' '.$db->rows[$db->count-1]->time_create,date('Y-m-d'))!=0))) {
					return array('result'=>'0','key'=>'4','comment'=>'Ответы на видеовопросы нулевого дня не даны, либо даны сегодня'); // Проверяем ответы на видеовопросы нулевого дня
				}
			}
			
			$pay=new pay();
			$pay_info=$pay->search_pay($id);
			
			if ($pay_info['ost_days']==0) {
				return array('result'=>'0','key'=>'5','comment'=>'Отсутствуют оплаченные дни'); // Проверяем ответы на видеовопросы нулевого дня
			}
			
			return array('result'=>'1','key'=>'6','comment'=>'Новый день может быть начат'); // В случае отсутствия проблем - новый день может быть начат
			
		}
		
		public function days_create($id=1){ // Функция создания нового дня
			$db=new db();
			$db_help=new db();
			$db_help_2=new db();
			$db->select_free('SELECT `days`,`days_l2`,`level` FROM `'.pre.'users` WHERE `id`=? LIMIT 1',array($id));
			
			$time=time();
			
			if ($db->rows[0]->level=='1') {
				
				$days=unserialize($db->rows[0]->days);
				if (!is_array($days)) { $days=array(); }
				
				$days[date('Y-m-d',$time)]['day']=count($days)+1; // Указываем номер дня
				
				$db_help->select('stat','date',array(date('Y-m-d',$time))); // Ищем статьи, которые должны появиться в определенную дату
				
				$cc=$db_help->count; // Отступ в случае наличия статей в дату
				
				for($i=0;$i<$db_help->count;$i++){
					$days[date('Y-m-d',$time)]['constr'][$i]['id']=$db_help->rows[$i]->inday;
					$days[date('Y-m-d',$time)]['constr'][$i]['type']='Статья';
					$days[date('Y-m-d',$time)]['constr'][$i]['read']='-';
					$days[date('Y-m-d',$time)]['constr'][$i]['srok']='1';
				}
				
				$db_help->select('inday','day,level',array($days[date('Y-m-d',$time)]['day'],$db->rows[0]->level)); 
				for($i=0;$i<$db_help->count;$i++){ // Заполняем заданиями этого дня
					$days[date('Y-m-d',$time)]['constr'][$i+$cc]['id']=$db_help->rows[$i]->id;
					$days[date('Y-m-d',$time)]['constr'][$i+$cc]['type']=$db_help->rows[$i]->type;
					$days[date('Y-m-d',$time)]['constr'][$i+$cc]['read']='-';
					$days[date('Y-m-d',$time)]['constr'][$i+$cc]['srok']='1';
											
					if ($db_help->rows[$i]->type=='Домашнее задание') { // Для домашнего задания - определяем срок выполнения
						$db_help_2->select('domz','inday',array($db_help->rows[$i]->id));
						$days[date('Y-m-d',$time)]['constr'][$i+$cc]['srok']=$db_help_2->rows[0]->srok;
					}
					
					if ($db_help->rows[$i]->type=='Замеры') { // Для замеров - определяем срок выполнения
						$db_help_2->select('zamer','inday',array($db_help->rows[$i]->id));
						$days[date('Y-m-d',$time)]['constr'][$i+$cc]['srok']=$db_help_2->rows[0]->srok;
					}
				}
				
				if ($db->update('users','days,say_banned','id',array(serialize($days),'',$id))) {
					$GLOBALS['user']->user->days=$days;
					
					return array('result'=>'1','key'=>'1','comment'=>'Для Вас начат <b>'.$days[date('Y-m-d',$time)]['day'].'</b> день I уровня');
				} else {
					return array('result'=>'0','key'=>'0','comment'=>'Новый день начать не удалось');
				}
				
			} else {
				
				$days_l2=unserialize($db->rows[0]->days_l2);
				if (!is_array($days_l2)) { $days_l2=array(); }
				
				$days_l2[date('Y-m-d',$time)]['day']=count($days_l2)+1; 
				
				$db_help->select('stat','date',array(date('Y-m-d',$time)));// Ищем статьи, которые должны появиться в определенную дату
				
				$cc=$db_help->count; // Отступ в случае наличия статей в дату
				
				for($i=0;$i<$db_help->count;$i++){
					$days_l2[date('Y-m-d',$time)]['constr'][$i]['id']=$db_help->rows[$i]->inday;
					$days_l2[date('Y-m-d',$time)]['constr'][$i]['type']='Статья';
					$days_l2[date('Y-m-d',$time)]['constr'][$i]['read']='-';
					$days_l2[date('Y-m-d',$time)]['constr'][$i]['srok']='1';
				}
				
				$db_help->select('inday','day,level',array($days_l2[date('Y-m-d',$time)]['day'],$db->rows[0]->level)); 
				
				for($i=0;$i<$db_help->count;$i++){ // Заполняем заданиями этого дня
					$days_l2[date('Y-m-d',$time)]['constr'][$i+$cc]['id']=$db_help->rows[$i]->id;
					$days_l2[date('Y-m-d',$time)]['constr'][$i+$cc]['type']=$db_help->rows[$i]->type;
					$days_l2[date('Y-m-d',$time)]['constr'][$i+$cc]['read']='-';
					$days_l2[date('Y-m-d',$time)]['constr'][$i+$cc]['srok']='1';
					
					if ($db_help->rows[$i]->type=='Домашнее задание') {
						$db_help_2->select('domz','inday',array($db_help->rows[$i]['id']));
						$days_l2[date('Y-m-d',$time)]['constr'][$i+$cc]['srok']=$db_help_2->rows[0]->srok;
					}
					
					if ($db_help->rows[$i]->type=='Замеры') {
							$db_help_2->select('zamer','inday',array($db_help->rows[$i]->id));
							$days_l2[date('Y-m-d',$time)]['constr'][$i+$cc]['srok']=$db_help_2->rows[0]->srok;
					}
				}
				
				if ($db->update('users','days_l2','id',array(serialize($days_l2),$id))) {
					$GLOBALS['user']->user->days_l2=$days_l2;
					
					return array('result'=>'1','key'=>'1','comment'=>'Для Вас начат <b>'.$days_l2[date('Y-m-d',$time)]['day'].'</b> день II уровня');
				} else {
					return array('result'=>'0','key'=>'0','comment'=>'Новый день начать не удалось');
				}
			}
			
		}
		
		public function get_day($id=0,$data='0000-00-00',$days=array()){ // Получение заданий дня по id, дате
			if (count($days)==0) { $days=$GLOBALS['user']->user->days; } // Если не задан конкретный день какого-либо ученика, то берем текущего ученика.
			foreach($days as $key => $value){ // Пробегаем по дням ученика
				if (($value['day']==$id)||($key==$data)) {
					return array('result'=>'1','key'=>'1','comment'=>'День найден','data'=>$key,'day'=>$value,'count'=>count($days)); // Выводим массив, содержащий дату, список заданий дня, размерность массива дней
				}
			}
			return array('result'=>'0','key'=>'0','comment'=>'Нет учебного дня');
		}
		
		public function test_rules($id,$days=array()){ // Проверяем, может ли ученик выполнять это задание
			if (count($days)==0) { $days=$GLOBALS['user']->user->days; } // Если не задан конкретный 
			foreach($days as $key => $value){
				for($i=0;$i<count($value['constr']);$i++){
					if ($value['constr'][$i]['id']==$id) { 
						$this->data['id']=$id; // idnum задания
						$this->data['day']=$value['day']; // id дня
						$this->data['data']=$key; // Дата, когда задание дано
						return true; 
					}
				}
			}
			return false;
		}
		
		public function setread($id,$days=array()){ // Изменение статуса прочитанности задания
			$db=new db();
			if (count($days)==0) { $days=$GLOBALS['user']->user->days; } // Если не задан конкретный 
			foreach($days as $key => $value){
				for($i=0;$i<count($value['constr']);$i++){
					if (($value['constr'][$i]['id']==$id)&&($days[$key]['constr'][$i]['read']=='-')) { 
						$days[$key]['constr'][$i]['read']='+';
						if ((string)$days[$key]['day']=='0') {
							if ($db->update('users','say_banned','id',array(serialize($days),$GLOBALS['user']->user->id))) { return true; }
						} else {
							if ($db->update('users','days','id',array(serialize($days),$GLOBALS['user']->user->id))) { return true; }
						}
						
					}
				}
			}
			return false;
		}
		
		public function get_one_day($day=array()){ // Вывод списка статей и арт-медитаций дня
			$day_result=array();
			$article=new article();
			$art=new artmeditation();
			for($i=0;$i<count($day['constr']);$i++){
				$day_result['count_constr']++;
				if ($day['constr'][$i]['read']=='+') {
					$day_result['count_constr_read']++;
				}
				if ($day['constr'][$i]['type']=='Статья') {
					$article_now=$article->getarticle($day['constr'][$i]['id']);
					if ($article_now['error']==0) {
						$day_result['constr'][]=array('id'=>$day['constr'][$i]['id'],'read'=>$day['constr'][$i]['read'],'title'=>$article_now['result']->name,'type'=>'articles'); 
					}
				}
				if ($day['constr'][$i]['type']=='Арт-медитация') {
					$art_now=$art->getartmeditation($day['constr'][$i]['id']);
					if ($art_now['error']==0) {
						$day_result['constr'][]=array('id'=>$day['constr'][$i]['id'],'read'=>$day['constr'][$i]['read'],'title'=>'<b>Арт-медитация:</b> '.$art_now['result']->name,'type'=>'artmeditations'); 
					}
				}
			}
			return $day_result;
		}
		
		function out(){
			return $this->html;
		}
	}
?>