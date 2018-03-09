<?php
	class questionnaire{ // Класс анкеты
		
		function questionnaire_save($data){
			$db=new db();
			
			$VK = new vkapi(api_id, secret_key);
			$array=explode('/',$data['post']['edit_9']);
			$api = $VK->api('users.get', array('access_token'=>access_token,'fields'=>'photo_100','user_ids'=>$array[count($array)-1],'v'=>'5.21'));
				
			if ($api['response'][0]['photo_100']!='') {
				copy($api['response'][0]['photo_100'],'photo/'.$GLOBALS['user']->user->id.'.jpg');
			}
			
			return $db->update('users','login,password,city,client,par,link,email,tel,cel','id',array($data['post']['edit_1'],$data['post']['edit_2'],$data['post']['edit_3'],serialize(array($data['post']['edit_4'],$data['post']['edit_5'],$data['post']['edit_6'])),serialize(array($data['post']['edit_7'],$data['post']['edit_12'],$data['post']['edit_13'],$data['post']['edit_14'],$data['post']['edit_15'],$data['post']['edit_16'],$data['post']['edit_8'])),$data['post']['edit_9'],$data['post']['edit_10'],$data['post']['edit_11'],$data['post']['edit_17'],$GLOBALS['user']->user->id));
		}
		
	}
?>