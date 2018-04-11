<?php
	class partner_model extends model{
		
		public function content(){
			if ($GLOBALS['user']->user->partner==0) {
				return array('0'=>false);
			} else {
				$db=new db();
				$db->select('partner','partner_id',array($GLOBALS['user']->user->id));
				
				$count=array();
				for($i=0;$i<$db->count;$i++){
					if ($db->rows[$i]->user_id!='') {
						$count[1]++;
					}
					$count[0]++;
				}
				
				return array('0'=>true,'1'=>$db,'2'=>$count);
			}
		}
		
		public function new_partner(){
			$db=new db();
			return $db->update('users','partner','id',array('1',$GLOBALS['user']->user->id));
		}
		
	}
?>