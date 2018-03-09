<?php
	class pays_model extends model{
		
		public function content(){
			$pay=new pay();
			$pay_info=$pay->search_pay($GLOBALS['user']->user->id);
			
			return $pay_info;
			
		}
		
	}
?>