<?php
	class artmeditations_view extends view{
	
		public function content_artmeditations($data){
			if ($data['error']) {
				$this->html='<h2>'.$data['result'].'</h2>';
			} else {
				$this->html='<h2>'.$this->setread_ico($data['setread']).$data['result']->name.'</h2>';
				if (trim($data['result']->photo)) {
					$this->html.='<div class="div_for_info"><div id="artmeditation_text" class="text_formated"><img src="'.$data['result']->photo.'" id="artmeditation_photo"><b>Инструкция: </b>'.str_replace('</p>','</p><div style="margin-top:20px;"></div>',$data['result']->body).'</div></div><div class="clear"></div>';
				} else {
					$this->html.='<div class="div_for_info">'.$data['result']->body.'</div>';
				}
				$this->html.='<div class="div_for_info">'.$data['result']->video.'</div>';
				$this->html.='<div class="div_for_audio">'.$data['result']->audio.'</div>';
				
				$this->html.='<div style="text-align:right; margin:15px 0;"><a href="https://vk.com/topic-85311796_31794957" target="_blank"><button class="button_white" style="width:200px; margin-right:20px;" id="button_1">Описать ощущения</button></a><button class="button_green" style="width:200px;" id="button_2" data-id="'.$data['result']->id.'" data-idnum="'.$data['idnum'].'">Выполнено</button></div>';
			}
			return $this->html;
		}
		
		public function artmeditation_save($data){
			$this->html=$this->standart_message($data);
			if ($data['error']==0) { $this->html.='<script>go("/lk/","3000");</script>'; }
			return $this->html;
		}
	
	}
?>