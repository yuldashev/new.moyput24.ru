<?php
	class trainig{ // Класс тренировок
		
		function face($id){
			return array('title'=>'','ico'=>'ico_trenirovka.jpg');
		}
		
		function gettrainig($id){
			$db=new db();
			
			$db->select('tren','',array());
			$select='';
			for($i=0;$i<$db->count;$i++){
				$inday=unserialize($db->rows[$i]->inday);
				for($j=0;$j<count($inday);$j++) { 
					if (($inday[$j]==$id)) {
						$select=$db->rows[$i]->link;
						$info['inday']=$db->rows[$i]->id;
					}
				}
			}
			if ($select!='') {
				if (strpos($select,'a.mp4')>0) {
					return array('error'=>'0','result'=>'DIRjWYKmS7k');
				}
				if (strpos($select,'b.mp4')>0) {
					return array('error'=>'0','result'=>'RGvFDzEC28Y');
				}
				if (strpos($select,'c.mp4')>0) {
					return array('error'=>'0','result'=>'xGkuxgAtQBo');
				}
			}
			return array('error'=>'1','result'=>'Тренировка не найдена');
			
		}
		
	}
?>