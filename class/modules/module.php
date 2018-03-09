<?php
	class module extends standard{
		
		public $name='',$module='',$link='',$type='',$order='',$background='4.jpg';
		public $data=array(),$html,$data_post=array(),$data_get=array(),$result=array();
		
		function init(){
			//if ($GLOBALS['user']->user['id']<1) { echo "<script> window.location.href = '/';</script>"; exit; }
			foreach($_POST as $key => $value){
				$data=new post_get($key);
				$this->data_post[$key]=$data->res();
			}
			foreach($_GET as $key => $value){
				$data=new post_get($key);
				if ($key!='get') {
					$this->data_get[$key]=$data->res();
				} else {
					$array=array();
					$array[0]=explode('|',$data->res());
					for($i=0;$i<count($array[0]);$i++){
						$array[1]=explode('=',$array[0][$i]);
						$this->data_get[$array[1][0]]=$array[1][1];
					}
				}
			}
			$this->data['post']=$this->data_post;
			$this->data['get']=$this->data_get;
		}
		
		public function recursion(){
			foreach ($this->data as $key => $value){
				if (strpos($this->html,'{'.$key.'}')!=0) {
					$this->html = str_replace('{'.$key.'}',$value,$this->html);
					$this->recursion();
				}
			}
		}
		
		public function uniquejs(){}
		
		public function js(){
			if (file_exists('js/modules/'.$this->module.'.js')) {
				$this->html='<script type="text/javascript" src="js/modules/'.$this->module.'.js"></script> ';
			}
		}
		
		public function css(){
			if (file_exists('css/modules/'.$this->module.'.css')) {
				$this->html='<link href="css/modules/'.$this->module.'.css" type="text/css" rel="stylesheet" />';
			}
		}
		
		public function content(){
			$this->html='';
		}
		
		function out(){
			return $this->html;
		}
	}
?>