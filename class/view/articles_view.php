<?php
	class articles_view extends view{
	
		public function content_articles($data){
			if ($data['error']) {
				$this->html='<h2>'.stripslashes($data['result']).'</h2>';
			} else {
				$this->html='<h2>'.$this->setread_ico($data['setread']).stripslashes($data['result']->name).'</h2>';
				$this->html.='<div class="div_for_info text_formated">'.stripslashes(str_replace('</p>','</p><div style="margin-top:20px;"></div>',$data['result']->body)).'</div>';
			
				$this->html.='<div style="text-align:right; margin:15px 0;"><button class="button_white link" style="width:200px; margin-right:20px;" data-link="/lk/">В личный кабинет</button><button class="button_green ajax" style="width:200px;" id="button_2" data-ajax="/lk/setread/" data-post="idnum='.$data['result']->inday.'">Выполнено</button></div>';
				
			}
			return $this->html;
		}
		
		public function all_articles($data){
			$this->html='<div id="all_articles_left">';
			$this->html.='<p class="select_all_articles all_articles" data-day="all">Все статьи</p>';
			$days=array();
			for($i=0;$i<count($data['result']);$i++){
				if (!in_array($data['result'][$i]['day'],$days)) {
					$this->html.='<p class="all_articles" data-day="'.$data['result'][$i]['day'].'">День '.$data['result'][$i]['day'].'</p>';
					$days[]=$data['result'][$i]['day'];
				}
			}
			$this->html.='</div>';
			$this->html.='<div id="all_articles_right">';
			for($i=0;$i<count($data['result']);$i++){
				$this->html.='<div style="width:236px; margin:16px; float:left; font-size:12px;" class="astats day'.$data['result'][$i]['day'].' dayall"><p class="imgs"><a href="/articles/articles/'.($data['result'][$i]['stat']['result']->inday).'/">'.($data['result'][$i]['stat']['result']->img).'</a></p><p style="border-bottom:1px solid #cdcdcd; height:auto;" class="titles"><a href="/articles/articles/'.($data['result'][$i]['stat']['result']->inday).'/"><b>'.stripslashes($data['result'][$i]['stat']['result']->name).'</b></a></p><div class="bodies"><a href="/articles/articles/'.($data['result'][$i]['stat']['result']->inday).'/">'.stripslashes($data['result'][$i]['stat']['result']->body).' ...</a></div><a href="/articles/articles/'.($data['result'][$i]['stat']['result']->inday).'/"><img src="images/i7.png" style="float:right;"></a><div class="clear"></div></div>';
			}
			$this->html.='</div>';
			$this->html.='<div class="clear"></div>';
			return $this->html;
		}
	}
?>