<?php
	class before_days_view extends view{
		
		public function content($data){
			$this->html='';
			foreach($data as $day => $value){
				if ($day!='count_line') {
					$this->html.='<div class="before_days_div spark"><a href="/lk/lk/lk/'.$day.'/"><div class="before_days_title">'.$day.' день</div></a><div class="before_days_body" onclick="go(\'/lk/lk/lk/'.$day.'/\',1000);">';
					for($i=0;$i<count($value['constr']);$i++){
						$this->html.='<p class="before_days_element">&nbsp;•&nbsp;<a href="/'.$value['constr'][$i]['type'].'/'.$value['constr'][$i]['type'].'/'.$value['constr'][$i]['id'].'/">'.stripslashes($value['constr'][$i]['title']).'</a></p>';
					}
					for($i=count($value['constr']);$i<$data['count_line'];$i++){
						$this->html.='<p class="before_days_element">&nbsp;</p>';
					}
					$this->html.='</div><a href="/lk/lk/lk/'.$day.'/">';
					$this->html.=$this->progress($value['count_constr'],$value['count_constr_read']);
					$this->html.='</a></div>';
				}
			}
			$this->html.='<div class="clear"></div>';
			return $this->html;
		}
		
		public function progress($count_constr,$count_constr_read){
			$html='<div class="progress_vn"><div class="progress_ob"><p class="progress_line" style="width:'.round(100*$count_constr_read/$count_constr).'%;"></p></div>';
			if (round(100*$count_constr_read/$count_constr)>=99) {
				$html.='<img src="images/day_complite.png" class="progress_complite">';
			}
			$html.='</div>';
			return $html;
		}
		
	}
?>