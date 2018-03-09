<?php
	class view extends standard{
		
		public $html;
		
		public function setread_ico($setread){
			if ($setread) { 
				$setread='<img src="images/ico_read.png" id="setread">'; 
			} else { 
				$setread=''; 
			}
			return $setread;
		}
		
		public function standart_message($data){
			if (!$data['error']) { $this->html='<script>info_generate("'.$data['title'].'","'.$data['result'].'","","success");</script>'; } else { $this->html='<script>info_generate("'.$data['title'].'","'.$data['result'].'","","error");</script>'; }
			return $this->html;
		}
		
	}
?>