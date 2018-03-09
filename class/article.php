<?php
	class article{ // Класс статей
		
		function face($id){
			$article=$this->getarticle($id);
			return array('title'=>$article['result']->name,'ico'=>'ico_statya.jpg');
		}
		
		function getarticle($id){
			$db=new db();
			$db->select('stat','inday',array($id)); 
			if ($db->count>0) {
				return array('error'=>'0','result'=>$db->rows[0]);
			} else {
				return array('error'=>'1','result'=>'Статья не найдена');
			}
		}
		
		function getarticlepre($id){
			$db=new db();
			$db->select('stat','inday',array($id)); 
			if ($db->count>0) {
				$article=$db->rows[0];
				
				$article->img='<img src="images/tree.jpg" style="width:236px; height:236px;">';
				if (file_exists('m/'.$id.'.jpg')) {
					$size=getimagesize('m/'.$id.'.jpg');
					$height=round(236*$size[1]/$size[0]);
					$article->img='<img src="'.'m/'.$id.'.jpg'.'" style="width:236px; height:'.$height.'px;">';
				}
				
				$body=trim(strip_tags($db->rows[0]->body));
				$array=explode(' ',$body);
				$line='';
				for($j=0;$j<min(20,count($array));$j++){
					$line.=$array[$j].' ';
				}
				
				$article->body=$line;
				
				return array('error'=>'0','result'=>$article);
			} else {
				return array('error'=>'1','result'=>'Статья не найдена');
			}
		}
		
	}
?>