<?php
	class standard{
		
		function set_array($array){ // Является ли переменная массивом. Если не является, то создается пустой массив
			if (is_array($array)) {
				return $array;
			} else {
				return array();
			}
		}
		
		function unserialize($string){ // Делается десериализация, если переменная не десериализуется, то вернет пустой массив
			$unserialize=unserialize($string);
			if ($unserialize) {
				return $unserialize;
			} else {
				return array();
			}
		}
		
		function month_rus($data){ // Возвращает название месяца на русском
			if (strpos($data,'-')) {
				$month=date('m',strtotime($data))+0;
			} elseif ($data>12) {
				$month=date('m',$data)+0;
			} else {
				$month=$data+0;
			}
			$array=array(
				'1'=>array('январь','января'),
				'2'=>array('февраль','февраля'),
				'3'=>array('март','марта'),
				'4'=>array('апрель','апреля'),
				'5'=>array('май','мая'),
				'6'=>array('июнь','июня'),
				'7'=>array('июль','июля'),
				'8'=>array('август','августа'),
				'9'=>array('сентябрь','сентября'),
				'10'=>array('октябрь','октября'),
				'11'=>array('ноябрь','ноября'),
				'12'=>array('декабрь','декабря')
			);
			return $array[$month][1];
		}
		
		function get_d($data){ // Возвращает день даты
			if (strpos($data,'-')) {
				$d=date('d',strtotime($data))+0;
			} else {
				$d=date('d',$data)+0;
			}
			return $d;
		}
		
		function create_option($array,$value){ // Возвращает структуру <option></option> из массива
			$option='';
			for($i=0;$i<count($array);$i++){
				$option.='<option value="'.$array[$i][0].'" ';
				if ($array[$i][0]==$value) { $option.='selected'; }
				$option.='>'.$array[$i][1].'</option>';
			}
			return $option;
		}
		
		function time_formated($time){ // Форматирует дату
			$time=str_replace(array(' ','.',',','-','ч'),':',trim($time));
			$array=explode(':',$time);
			$a='';
			$b='';
			for($i=0;$i<count($array);$i++){
				if (($array[$i]>0)||($array[$i]==='0')||($array[$i]==='00')) { if ($a=='') { $a=trim($array[$i]); } else { $b=trim($array[$i]); } }
			}
			if (($a!='')&&($b!='')) { return str_pad($a,2,'0',STR_PAD_LEFT).':'.str_pad($b,2,'0',STR_PAD_LEFT); } else { return false; }
		}
		
		function insert_update($table,$test_line,$test_array,$td,$post){ // Делает update базы данных, если значение не существовало, то оно добавляется в БД
			$db=new db();
			$db->select($table,$test_line,$test_array);
			if ($db->count>0) {
				if ($db->update($table,$td,$test_line,array_merge($post,$test_array))) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($db->insert($table,$td,$post)) {
					return true;
				} else {
					return false;
				}
			}
		}
		
		function get_week($day){ // Возвращается номер недели
			return (floor(($day-1)/7)+1);
		}
		
		function data_add($data,$add){ // Делается отступ от даты на add дней
			return date('Y-m-d',strtotime($data)+$add*24*60*60);
		}
		
		function save_image($url,$array){ // Обработка, сохранение фото
			$downloads = new download();
			$size=getimagesize($url);
			for($i=0;$i<count($array);$i++){
				if (file_exists($array[$i]['url'])) { unlink($array[$i]['url']); }
				if ($array[$i]['w']>0) { $w=$array[$i]['w']; } else { $w=$array[$i]['h']/$size[0]*$size[1]; }
				if ($array[$i]['h']>0) { $h=$array[$i]['h']; } else { $h=$array[$i]['w']/$size[0]*$size[1]; }
				$downloads -> img_resize($url, $array[$i]['url'], $w, $h);
			}
			unlink($url);
		}
		
		function get_all_id($type){ // Вывод всех ID пройденных заданий, соответствующих типу
			$array=array();
			foreach($GLOBALS['user']->user->days as $data => $value){
				for($i=0;$i<count($value['constr']);$i++){
					if (($type=='')||($value['constr'][$i]['type']==$type)) {
						$array[]=array('id'=>$value['constr'][$i]['id'],'day'=>$value['day']);
					}
				}
			}
			return $array;
		}
		
		function str2url($string) { // Транслит слов
			$converter = array(
				'а' => 'a',   'б' => 'b',   'в' => 'v',
				'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
				'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',
				'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',
				'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
				'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
				
				'А' => 'A',   'Б' => 'B',   'В' => 'V',
				'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
				'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
				'И' => 'I',   'Й' => 'Y',   'К' => 'K',
				'Л' => 'L',   'М' => 'M',   'Н' => 'N',
				'О' => 'O',   'П' => 'P',   'Р' => 'R',
				'С' => 'S',   'Т' => 'T',   'У' => 'U',
				'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
				'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
				'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
				'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
			);
			return strtr($string, $converter);
		}
	}
?>