<?php
	class progress_model extends model{
		
		public function get_progress_photo($data){
			$result=array();
			for($i=1;$i<=4;$i++){
				if (file_exists('photo/my_'.$GLOBALS['user']->user->id.'_'.$i.'.jpg')) {
					$result[]=array('photo/my_'.$GLOBALS['user']->user->id."_".$i.'.jpg?key='.time(),getimagesize('photo/my_'.$GLOBALS['user']->user->id."_".$i.'.jpg'));
				} else {
					$result[]=array('images/no-image.jpg',getimagesize('images/no-image.jpg'));
				}
			}
			return $result;
		}
		
		public function downloads_photo($data){
			$downloads = new download();
			$downloads -> simple();
			
			if (!$downloads->result['download']) {
				$this->data['error']='1'; // Ошибка есть
				$this->data['title']='Ошибка.';
				$this->data['result']='Не удалось загрузить файл'; // Выводим причину
			} else {
				$this->save_image($downloads->result['pathname'],array(array('url'=>'photo/my_'.$GLOBALS['user']->user->id."_".($data["get"]["id"]+1).'.jpg','w'=>'201','h'=>'201')));
				$this->data['error']='0'; // Ошибки нет
				$this->data['title']='Успешно.'; //Заголовок
				$this->data['result']='Фото загружено'; // Выводим причину
				$this->data['url']='photo/my_'.$GLOBALS['user']->user->id."_".($data["get"]["id"]+1).'.jpg?key='.time();
				$this->data['id']=$data["get"]["id"];
			}
			return $this->data;
		} 
		
		public function get_progress_graph(){ // Получение данных для графика изменения веса
			$fooddiary=new fooddiary();
			$fooddiarys=$fooddiary->getfooddiaryuser($GLOBALS['user']->user->id);
			$result=array();
			foreach($GLOBALS['user']->user->days as $date => $value){
				for($j=0;$j<$fooddiarys->count;$j++){
					if ($date==$fooddiarys->rows[$j]->day) {
						if ((float)$fooddiarys->rows[$j]->ves_1>40) {
							$result[0][]=$value['day'];
							$result[1][]=(float)$fooddiarys->rows[$j]->ves_1;
						}
					}
				}
			}
			return $result;
		}
		
		public function get_progress_table(){ // Получение таблицы
			$result=array();
			$result['now']=count($GLOBALS['user']->user->days);
			$fooddiary=new fooddiary();
			$fooddiarys=$fooddiary->getfooddiaryuser($GLOBALS['user']->user->id);
			
			$result['table'][0]=array($GLOBALS['user']->user->par[1],$GLOBALS['user']->user->par[3],$GLOBALS['user']->user->par[4],$GLOBALS['user']->user->par[5]);
			
			$week=0;
			$inday_measurements='';
			$inday_fooddiary='';
			foreach($GLOBALS['user']->user->days as $date => $value){
				for($i=0;$i<count($value['constr']);$i++){
					if ($value['constr'][$i]['type']=='Замеры') {
						$week++;
						$inday_measurements=$value['constr'][$i]['id'];
					}
					if ($value['constr'][$i]['type']=='Дневник питания') {
						$inday_fooddiary=$value['constr'][$i]['id'];
					}
				}
				for($j=0;$j<$fooddiarys->count;$j++){
					if ($date==$fooddiarys->rows[$j]->day) {
						if (($result['table'][$week][0]=='')&&($fooddiarys->rows[$j]->ves_1!='')) {
							$result['table'][$week][0]=$fooddiarys->rows[$j]->ves_1;
							$result['table'][$week][4]='/fooddiarys/fooddiarys/'.$inday_fooddiary.'/';
						}
						if (($result['table'][$week][1]=='')&&(count($this->unserialize($fooddiarys->rows[$j]->newpar))>0)) {
							$newpar=$this->unserialize($fooddiarys->rows[$j]->newpar);
							$result['table'][$week][1]=$newpar[0];
							$result['table'][$week][2]=$newpar[1];
							$result['table'][$week][3]=$newpar[2];
							$result['table'][$week][5]='/measurementss/measurementss/'.$inday_measurements.'/';
						}
					}
				}
			}
			return $result;
		}
	}
?>