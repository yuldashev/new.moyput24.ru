<?php
	class lk extends module{
		
		public $name='Личный кабинет',$module='lk',$link='/lk',$background='background.jpg';
		
		public function lk(){
			$this->init();
		}
		
		public function testautorization(){
			if ($GLOBALS['user']->user->id<1) {
				$user=new user();
				$user->out();
				
				$view=new lk_view();
				$this->html=$view->outs();
				return $this->html;
				exit();
			}
		}
		
		public function info(){
			
			//Вывод всей информации
			
			$model=new lk_model();
			$view=new lk_view();
			$this->html=$view->info_ok($model->info_ok($this->data_post));
			
			//Дополнить инормацией о днях самоконтроля, уведомлениями
			$this->html.=$view->get_top($model->get_top());
		}
		
		public function username(){
			$model=new lk_model();
			$view=new lk_view();
			$this->html=$view->username();
		}
		
		public function userface(){
			$model=new lk_model();
			$view=new lk_view();
			$this->html=$view->userface();
		}
		
		public function content(){
			
			$model=new lk_model();
			$view=new lk_view();
			
			$this->html='Не создано';
			
			if (($this->data_get['id']=='')||($this->data_get['id']=='lk')) {
				$this->html=$view->content_lk($model->content_lk($this->data)); // Вывод информации, если выбран режим кабинета
			}
		}
		
		public function outs(){
			
			$user=new user();
			$user->out();
			
			$view=new lk_view();
			$this->html=$view->outs();
			
		}
		
		public function text(){
			
			$view=new lk_view();
			$this->html=$view->text($this->data);
			
		}
		
		public function setread(){
			
			$model=new lk_model();
			$view=new lk_view();
			$this->html=$view->setread($model->setread($this->data));
			
		}
		
		public function downloads_photo(){
			$model=new lk_model();
			$view=new lk_view();
			$this->html=$view->downloads_photo($model->downloads_photo($this->data));
		}
	}
?>