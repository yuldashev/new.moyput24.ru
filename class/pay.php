<?php
	/*
		Класс, работающий с оплатами
	*/
	class pay{
		
		public function pay(){
			
		}
		
		public function search_pay($id='1'){ //Поиск оплат клиента, вывод информации о наличии дней
			$db=new db();
			$db->select_free('SELECT * FROM `'.pre.'pay` WHERE `user`=? ORDER by `id`',array($id));
			$result=array('ost_days'=>0);
			for($i=0;$i<$db->count;$i++){
				
				if ($db->rows[$i]->days!='') { $days=unserialize($db->rows[$i]->days); } else { $days=array(); }
				
				if (($db->rows[$i]->count_days>0)&&($db->rows[$i]->days!='')) { $ost_days=$db->rows[$i]->count_days-count($days); } else { $ost_days=round(($db->rows[$i]->finish-time())/(24*60*60)); if ($ost_days<0) { $ost_days=0; } }
				$result[]=array('start'=>$db->rows[$i]->start,'finish'=>$db->rows[$i]->finish,'count_days'=>$db->rows[$i]->count_days,'days'=>$days,'ost_days'=>$ost_days);
				
				$result['ost_days']+=$ost_days;
			}
			return $result;
		}
		
		function out(){
			return $this->html;
		}
		
	}
?>