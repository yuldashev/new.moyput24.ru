<?php
class post_get{
	var $par;
	function post_get($name,$strip=0){
		$str=false;
		if (isset($_POST[$name])) {
			$str=$_POST[$name];
		} elseif (isset($_GET[$name])) {
			$str=$_GET[$name];
		} elseif (isset($_COOKIE[$name])) {
			$str=$_COOKIE[$name];
		}
		if (!is_array($str)) {
			if ($strip==0) {
				$str=trim(strip_tags($str));
			}
			$str=trim($str);
			if ($strip==2) {
				$str = str_replace('script', '', $str); 
				$str = str_replace('SCRIPT', '', $str);
			}
			$str=str_replace("<?php","",$str);
			$str=str_replace("<?","",$str);
			$str=str_replace("?>","",$str);
			if (!get_magic_quotes_gpc()) {
				$str=addslashes($str);
			}
		} else {
			$str=$this->clean_array($str);
		}
		$this->par=$str;
	}
	
	function clean_array($array){
		foreach($array as $key => $value){
			if (is_array($value)) { 
				$array[$key]=$this->clean_array($value); 
			} else { 
				$array[$key]=addslashes(trim(strip_tags($value)));
			}
		}
		return $array;
	}
	
	function res(){
		return $this->par;
	}
}
?>