<?php
	class videos_view extends view{
		
		public function content($data){
			for($i=0;$i<$data->count;$i++){					
				$this->html.='
					<div class="video_face link" data-link="/videos/videos/'.$data->rows[$i]->id.'/">
						<div class="video_body"><a href="/videos/videos/'.$data->rows[$i]->id.'/">'.$data->rows[$i]->body.'</a></div>
						<div class="video_title">'.$data->rows[$i]->title.'</div>
					</div>';
			}
			return $this->html;
		}
		
		public function content_single($data){
			$this->html='<h2>'.$data->rows[0]->title.'</h2>';
			$this->html.='<div id="video_body" class="text_formated" style="margin:0 15px;">'.$data->rows[0]->body.'</div>';
			return $this->html;
		}
		
	}
?>