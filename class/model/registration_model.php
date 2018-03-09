<?php
	class registration_model extends model{
		
		public function in_ok($data){
			$db=new db();
			$db->select('users','login,password',array($data['login'],$data['password']));
			if ($db->count==0) {
				$this->data['error']='1';
			} else {
				$this->data['error']='0';
				$this->data['result']=$db->rows[0];
				$user=new user();
				$user->setCookie($data['login'],$data['password'],salt);
			}
			return $this->data;
		}
	}
?>