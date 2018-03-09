<?php
	class vebinars_view extends view{
		
		public function content($data){
			$this->html.='<center>';
			for($i=0;$i<$data->count;$i++){
				if ($data->rows[$i]->user==$GLOBALS['user']->user->id) {
				$this->html.='
					<div class="vebinar_face link spark" data-link="/vebinars/vebinars/'.$data->rows[$i]->id.'/">
						<div class="vebinar_body"><a href="/vebinars/vebinars/'.$data->rows[$i]->id.'/"><img src="/'.$data->rows[$i]->img.'"></a></div>
						<div class="vebinar_title"><p style="height:38px; text-align:left;">'.$data->rows[$i]->title.'</p><div class="line"></div><p style="margin-top:5px;">'.$data->rows[$i]->date.'</p></div>
					</div>';
				} else {
				$this->html.='
					<div class="vebinar_face link spark">
						<div class="vebinar_body"><img src="/'.$data->rows[$i]->img.'"></div><p style="color:#cc0000; position:absolute; top:10px; z-index:100; padding:5px; background:rgba(255,255,255,0.9); font-size:12px; font-weight:700;">Недоступно. Для просмотра <br>обратитесь к куратору</p>
						<div class="vebinar_title"><p style="height:38px; text-align:left;">'.$data->rows[$i]->title.'</p><div class="line"></div><p style="margin-top:5px;">'.$data->rows[$i]->date.'</p></div>
					</div>';
				}
			}
			$this->html.='</center>';
			return $this->html;
		}
		
		public function content_single($data){
			$this->html='<h2>'.$data->rows[0]->title.'</h2>';
			$this->html.='<div id="vebinar_body" class="text_formated" style="margin:0 15px;">'.$data->rows[0]->body.'</div>';
			return $this->html;
		}
		
	}
?>