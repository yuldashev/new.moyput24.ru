<?php
	class template{
	
		public $html;
		public $data=array();
		
		public function template($tpl){
		
			$module = new post_get("module","1");
			
			if ($module->res()=='') { $this->html = file_get_contents('tpl/'.$tpl.'.tpl'); } else { if (file_exists('tpl/'.$module->res().'.tpl')) { $this->html = file_get_contents('tpl/'.$module->res().'.tpl'); } else { $this->html = file_get_contents('tpl/lk.tpl'); }}
			
			foreach ($GLOBALS['language'] -> rus as $key => $value){
				$this->data[$key] = $GLOBALS['language'] -> rus[$key];
			}

			$dirct="tpl";
			$hdl=opendir($dirct);
			while ($file = readdir($hdl))
			{
				if (($file!=".")&&($file!=".."))
					{
						if ($file!=$tpl.'.tpl') {
							$this->data[str_replace('.tpl','',$file)] = file_get_contents('tpl/'.$file);
						}
					}
			}
			closedir($hdl);
			
		}
		
		public function out(){
			$this->recursion();
			header('Content-Type: text/html; charset=utf-8');
			echo $this->html;
		}
		
		private function recursion(){
			preg_match_all("/\{+\w+\}/i", $this->html, $matches, PREG_PATTERN_ORDER);
			
			$modules = new post_get("module","1");
			
			for ($i=0;$i<count($matches[0]);$i++) {
				if (strpos($matches[0][$i],'class')==0) {
					$this->html = str_replace($matches[0][$i],$this->data[str_replace(array('{','}'),'',$matches[0][$i])],$this->html);
				} else {
					$matches_array=explode('_',str_replace(array('{','}'),'',$matches[0][$i]));
					$class=$matches_array[1];
					if ($class=='auto') { if ($modules->res()!='') { $class=$modules->res(); } else { $class="lk"; }}
					$method=$matches_array[2];
					$module=new $class();
					$module->$method();
					$this->html = str_replace($matches[0][$i],$module->html,$this->html);
				}
			}
		}
	}
?>