<?php
	class youssous_view extends view{
		
		public function content_youssous($data){
			if ($data['error']) {
				$this->html='<h2>'.$data['result'].'</h2>';
			} else {
				$this->html='<h2>'.$data['result']->name.'</h2>';
				$this->html.='<div class="div_for_info">'.$data['result']->body.'</div>';
				$this->html.='<h2>'.stripslashes($data['result']->q).'</h2>';
				
				$this->html.='<div><textarea id="answer" class="input" data-error_title="Ответ." data-error_body="Пожалуйста, заполните." placeholder="Ответ. Пожалуйста, заполните.">'.$data['answer']->otvet.'</textarea></div>';
				
				$this->html.='<div style="text-align:center; margin:15px 0;"><button class="button_green" style="width:200px;" id="button_1" data-idnum="'.$data['idnum'].'" data-id="'.$data['result']->id.'">Ответить</button></div>';
			}
			return $this->html;
		}
		
		public function youssou_save($data){
			$this->html=$this->standart_message($data);
			if ($data['error']==0) { $this->html.='<script>go("/lk/","3000");</script>'; }
			return $this->html;
		}
		
	}
?>