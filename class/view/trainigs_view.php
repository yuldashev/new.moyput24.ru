<?php
	class trainigs_view extends view{
	
		public function content_trainigs($data){
			if ($data['error']) {
				$this->html='<h2>'.$data['result'].'</h2>';
			} else {
				$this->html='<h2>'.$this->setread_ico($data['setread']).$data['result']['title'].'</h2>';
				$this->html.='<div class="div_for_info"><iframe src="https://www.youtube.com/embed/'.$data['result']['body'].'?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen id="iframe_for_video"></iframe></div>';
			
				$this->html.='<div style="text-align:right; margin:15px 0;"><button class="button_white link" style="width:200px; margin-right:20px;" data-link="/lk/">В личный кабинет</button><button class="button_green ajax" style="width:200px;" id="button_2" data-ajax="/lk/setread/" data-post="idnum='.$data['inday'].'">Выполнено</button></div>';
			}
			return $this->html;
		}
	
	}
?>