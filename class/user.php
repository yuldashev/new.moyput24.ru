<?php
	class user extends standard{
		public  $user = '';
		public  $authorization = false;
		
		public function user(){
			$login = new post_get('login');
			$password = new post_get('password');
			
			if (($login->res()!='')&&($password->res()!='')) {
				$db = new db();
				$db->select_free("SELECT * FROM `".pre."users` WHERE `login`=? AND `password`=?",array($login->res(),$password->res()));
				if ($db->count==1) { 
					$this->authorization = true; 
					$db->rows[0]->days=$this->unserialize($db->rows[0]->days);
					if (count($db->rows[0]->days)==0) {
						$db->rows[0]->days=$this->unserialize($db->rows[0]->say_banned);
						if (count($db->rows[0]->days)==0) {
							$db->rows[0]->days=unserialize('a:1:{s:10:"'.date('Y-m-d').'";a:2:{s:3:"day";i:0;s:6:"constr";a:9:{i:0;a:4:{s:2:"id";s:3:"923";s:4:"type";s:22:"Видеовопрос";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:1;a:4:{s:2:"id";s:3:"924";s:4:"type";s:22:"Видеовопрос";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:2;a:4:{s:2:"id";s:3:"925";s:4:"type";s:22:"Видеовопрос";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:3;a:4:{s:2:"id";s:3:"931";s:4:"type";s:22:"Видеовопрос";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:4;a:4:{s:2:"id";s:1:"3";s:4:"type";s:12:"Статья";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:5;a:4:{s:2:"id";s:1:"4";s:4:"type";s:12:"Статья";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:6;a:4:{s:2:"id";s:2:"26";s:4:"type";s:12:"Статья";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:7;a:4:{s:2:"id";s:3:"142";s:4:"type";s:12:"Статья";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}i:8;a:4:{s:2:"id";s:3:"939";s:4:"type";s:12:"Статья";s:4:"read";s:1:"-";s:4:"srok";s:1:"1";}}}}');
						}
					}
					$db->rows[0]->days_l2=$this->unserialize($db->rows[0]->days_l2);
					$db->rows[0]->client=$this->unserialize($db->rows[0]->client);
					$db->rows[0]->news=$this->unserialize($db->rows[0]->news);
					$db->rows[0]->par=$this->unserialize($db->rows[0]->par);
					$db->rows[0]->dnevnik=$this->unserialize($db->rows[0]->dnevnik);
					$this->user = $db->rows[0]; 
					$this->setCookie($login->res(),$password->res());
				}
			}
		}
		
		public function setCookie($login,$password){
			setcookie("login",$login,time()+30*24*60*60,'/',base_domain);
			setcookie("password",$password,time()+30*24*60*60,'/',base_domain);
		}
		
		public function setCookieDomain($login,$password,$domain){
			setcookie("login",$login,time()+30*24*60*60,'/',$domain);
			setcookie("password",$password,time()+30*24*60*60,'/',$domain);
		}
		
		function out(){
			$this->setCookie('out','out');
		}
	}
?>