<?php
	class chart{
		
		public function line($title,$id,$lines,$points,$countgridlines){
			$key=mt_rand(1111,9999);

			$html="<script>$(function(){
				
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart".$key.");

				function drawChart".$key."() {      
					var data = new google.visualization.DataTable();";
				
			for($i=0;$i<count($lines);$i++){
				$html.="data.addColumn('".$lines[$i][0]."', '".$lines[$i][1]."');";
			}
			
			$rows=array();
			for($i=0;$i<count($points[0]);$i++){
				$array=array();
				for($j=0;$j<count($points);$j++){
					if ($points[$j][$i]!='') { $array[]=$points[$j][$i]; }
				}
			if ((count($rows)==0)||(count($array)==count(explode(',',$rows[count($rows)-1])))) { $rows[]='['.implode(',',$array).']'; }
			}

			$html.="data.addRows([".implode(',',$rows)."]);

					var options = {
						  title: '".$title."',
						  curveType: 'function',
						  legend: { position: 'bottom' },
						  hAxis: {
							gridlines: {count: ".$countgridlines[0]."}
						  }
					};

					var chart = new google.visualization.LineChart(document.getElementById('".$id."'));

					chart.draw(data, options);
				}	
			});</script>";
			return $html;
		}
	}
?>