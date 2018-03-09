<?php
	class before_days_model extends model{
		
		public function content($data){
			$result=array();
			$day=new days();
			$result['count_line']=0;
			foreach($GLOBALS['user']->user->days as $date => $value){
				$result[$value['day']]=$day->get_one_day($value);
				$result['count_line']=max($result['count_line'],count($result[$value['day']]['constr']));
			}
			return $result;
		}
	}
?>