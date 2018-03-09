<?php
	class lk_view extends view{
		
		public function info_ok($data){
			if (trim($data['result'])!='') { return '<p>'.$data['result'].'</p>'; } else { return ''; }
		}
		
		public function get_top($data){
			if (count($data)==0) { $this->html=''; } else { $this->html=stripslashes('<p>'.implode('</p><p>',$data).'</p>'); }
			return $this->html;
		}
		
		public function content(){
			
		}
		
		public function content_lk($data){
			if ($data['error']) {
				$this->html='<h2 style="line-height:1.5; font-size:16px;">'.(trim($GLOBALS['user']->user->client[1])!=''?$GLOBALS['user']->user->client[1].', ':'').'Ваш личный кабинет отключён по причине окончания оплаченных дней. <br>Для того, чтобы продолжить прохождение курса похудения напишите консультанту <a href="https://vk.com/id408234457" target="_blank" style="border-bottom:1px dotted #777;"><b>Альбине</b></a></h2>';
			} else {
				$this->html='<h2>День '.$data['day'].'</h2>
				<center>';
				$read=array('+'=>'<span class="workread_1">Выполнено</span>','-'=>'<span class="workread_0">Не выполнено</span>');
				
				if ($GLOBALS['user']->user->city=='') {
					$this->html.='
					<div class="workface" data-link="/questionnaires/">
						<div class="workico"><img src="images/no_questionnaires.png"></div>
						<div class="worktype" style="text-align:left;">Анкета<br><small>необходимо заполнить</small></div>
						<div class="worktitle"></div>
						<div class="workread"><span class="workread_0">Не заполнена</span></div>
					</div>';
				}
				
				$this->html.='
				<div class="workface" data-link="/fooddiaryscomments/" id="new_fooddiaryscomments" style="display:none;">
					<div class="workico"><img src="images/fooddiaryscomments.png"></div>
					<div class="worktype" style="text-align:left;">Комментарий<br><small>куратора на дневник куратора</small></div>
					<div class="worktitle"></div>
					<div class="workread"><span class="workread_0">Не прочитано</span></div>
				</div>';
					
				for($i=0;$i<count($data['work']);$i++){
					$this->html.='
					<div class="workface" data-link="/'.$data['work'][$i]['class'].'/'.$data['work'][$i]['class'].'/'.$data['work'][$i]['id'].'/">
						<div class="workico"><img src="images/'.$data['work'][$i]['face']['ico'].'"></div>
						<div class="worktype">'.$data['work'][$i]['type'].'</div>
						<div class="worktitle">'.stripslashes($data['work'][$i]['face']['title']).'</div>
						<div class="workread '.(((trim(strip_tags($read[$data['work'][$i]['read']]))=="Не выполнено")&&($data['work'][$i]['class']=="youssous")&&($data['day']==$GLOBALS['user']->user->days[date('Y-m-d')]['day']))?'youssous_go':'').'">'.$read[$data['work'][$i]['read']].'</div>
					</div>';
				}
				$this->html.='</center><div class="clear"></div>';
			}
			return $this->html;
		}
		
		public function outs(){
			$this->html='<script>go("/","0");</script>';
			return $this->html;
		}
		
		public function text($data){
			$this->html='<script>create_shadow(\''.$GLOBALS['language'] -> rus[$data['post']['text'].'_title'].'\',\''.$GLOBALS['language'] -> rus[$data['post']['text'].'_body'].'\',\''.$GLOBALS['language'] -> rus[$data['post']['text'].'_width'].'\'); </script>';
			return $this->html;
		}
		
		public function username(){
			if (($GLOBALS['user']->user->client[0]=='')&&($GLOBALS['user']->user->client[1]=='')) {
				return 'Заполнить<br>анкету';
			} else {
				return $GLOBALS['user']->user->client[0].'<br>'.$GLOBALS['user']->user->client[1];
			}
		}
		
		public function userface(){
			if (!file_exists('photo/'.$GLOBALS['user']->user->id.'.jpg')) {
				return '<img src="images/no-face.jpg" id="userface">';
			} else {
				return '<img style="width:68px; height:auto;" src="photo/'.$GLOBALS['user']->user->id.'.jpg?id='.time().'" id="userface">';
			}
		}
		
		public function downloads_photo($data){
			$this->html=$this->standart_message($data);
			$this->html.='<script>$(function(){ $("#userface").attr({"src":"'.$data['url'].'"}); })</script>';
			return $this->html;
		}
		
		public function setread($data){
			return $this->standart_message($data);
		}
		
	}
?>