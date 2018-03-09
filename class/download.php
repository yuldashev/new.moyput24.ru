<?php
	class download extends standard{
		var $result=array();
		public function simple(){
			$targetFolder = '/uploads';
			$tempFile = $_FILES['my-file']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['my-file']['name'];
			
			$fileTypes = array('jpg','jpeg','gif','png','JPG','JPEG');
			$fileParts = pathinfo($_FILES['my-file']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$this->str2url($targetFile));
				$this->result['download']=true;
				$this->result['name']=$_FILES['my-file']['name'];
				$this->result['pathname']=$this->str2url($targetFile);
				$this->result['ext']=$fileParts['extension'];
				
			} else {
				$this->result['download']=false;
			}
		}
		
		public function img_resize($src, $dest, $width, $height, $rgb=0xFFFFFF, $quality=100){
			if (!file_exists($src)) return false;
			 
			$size = getimagesize($src);
			 
			if ($size === false) return false;
			$format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
			$icfunc = "imagecreatefrom" . $format;
			if (!function_exists($icfunc)) return false;
			
			$x_ratio = $width / $size[0];
			$y_ratio = $height / $size[1];
			 
			$ratio       = max($x_ratio, $y_ratio);
			$use_x_ratio = ($x_ratio == $ratio);
			 
			$new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
			$new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
			$new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
			$new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
			 
			$isrc = $icfunc($src);
			$idest = imagecreatetruecolor($width, $height);
			$dstX=0;
			$dstY=0;
			$dstW=$width; 
			$dstH=$height;
			$srcX=($size[0]-$width/$ratio)/2; 
			$srcY=($size[1]-$height/$ratio)/2;
			$srcW=$size[0]-2*$srcX; 
			$srcH=$size[1]-2*$srcY; 
			 
			 
			imagecopyresampled($idest, $isrc, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);
			 
			imagepng($idest, $dest);
			 
			imagedestroy($isrc);
			imagedestroy($idest);
			return true;
		}
	}
?>