<?php
	class progress_view extends view{
		
		public function get_progress_photo($data){
			$this->html='<h2>Прогресс</h2>';
				
			$this->html.='<center>';
			$type_photo=array('До (вид спереди)','До (вид сбоку)','После (вид спереди)','После (вид сбоку)');
			for ($i=0;$i<4;$i++) {
				if ($i==2) {
					$this->html.='<div id="ico_right"><img src="images/ico_right.png"></div>';
				}
				$this->html.='<div class="download photo spark" id="photo_'.$i.'" data-id="'.$data['day'].'"><div class="photo_conteiner"><div class="photo_div"><img src="'.$data[$i][0].'" id="my_photo_'.$i.'"></div><div class="photo_div_comment">'.$type_photo[$i].'</div></div><img src="images/download.png" class="photo_download"></div>';
			}
			$this->html.='</center>';
			
			return $this->html;
		}
		
		public function downloads_photo($data){
			$this->html=$this->standart_message($data);
			$this->html.='<script>$(function(){ $("#my_photo_'.$data['id'].'").attr({"src":"'.$data['url'].'"}); })</script>';
			return $this->html;
		}
		
		public function get_progress_table($data){
			$this->html='<h2>Замеры</h2>';
			$this->html.='<table class="table">
				<tr class="first_tr table_title">
					<td>&nbsp;</td>
					<td>До начала курса</td>';
			for($i=1;$i<=8;$i++){
				$this->html.='<td>'.$i.'<br><small style="font-weight:300;">неделя</small></td>';
			}
			$this->html.='</tr>';
			$type=array('Вес, кг','Обхват груди, см','Обхват талии, см','Обхват бедер, см');
			for ($j=0;$j<4;$j++) {
				$this->html.='
					<tr>
						<td class="table_title">'.$type[$j].'</td>';
				for($i=0;$i<=8;$i++){
					$link=$j==4?4:5;
					if ($data['table'][$i][$j]!='') { $this->html.='<td class="link hover" data-link="'.$data['table'][$i][$link].'">'.$data['table'][$i][$j].'</td>'; } else { $this->html.='<td class="link hover" data-link="'.$data['table'][$i][$link].'"><small>Вы не ввели данные на этой неделе</small></td>'; }
				}
				$this->html.='</tr>';
			}
			$this->html.='</table>';
			return $this->html;
		}
		
		public function get_progress_graph($data){
			$this->html='<h2>Движение веса по дням</h2>';
			$chart=new chart();
			$this->html.='<div id="curve_chart" style="width:100%;height:400px;"></div>'.$chart->line('','curve_chart',array(array('number','День'),array('number','Вес')),array($data[0],$data[1]),array(ceil(count($data[0])/7),0));
			return $this->html;
		}
	}
?>