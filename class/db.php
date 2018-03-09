<?php
	class db{
	
		public $link;
		public $pre;
		public $last;
		public $count;
		public $sth;
		public $rows=array();
		
		public function db(){
			$this->link = new PDO ( 'mysql:host=' . dbhost . ';dbname=' . dbname, dbuser, dbpass );  
			$this->link->exec('SET NAMES utf8');
		}
		
		public function select($table, $td, $post, $order = '', $limit = '', $where_log = 'AND'){
			
			$start_table=$table; 
			$table=pre.$table;
			
			$mas_td=explode(',',$td);
			$count=count($mas_td);
			$line_1='';
			$while='';
			if ($mas_td[0]!='') {
				for ($i=0;$i<$count;$i++) {
					if ($i<$count-1) {
						$line_1.='`'.$mas_td[$i].'`=? '.$where_log; 
					} else {
						$line_1.='`'.$mas_td[$i].'`=?'; 
					}
				}
				$while=" WHERE ".$line_1;
			}
			if ($order!='') { $order = ' ORDER by '.$order; }
			if ($limit!='') { $limit = ' LIMIT '.$limit; }
			
			$sth = $this->link->prepare("SELECT * FROM `".$table."` ".$while." ".$order." ".$limit);
			$sth->execute($post);
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,"SELECT * FROM `".$table."` ".$while." ".$order." ".$limit,serialize($post),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				$this->count = $sth->rowCount();
				$this->rows = $sth->fetchAll(PDO::FETCH_CLASS);
				return true;
			}
		}
		
		public function select_free($string,$array,$fetchAll=1){
			$sth = $this->link->prepare($string);
			@$sth->execute($array);
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,$string,serialize($array),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				$this->count = $sth->rowCount();
				if ($fetchAll==1) { $this->rows = $sth->fetchAll(PDO::FETCH_CLASS); } else { $this->sth=$sth; }
				return true;
			}
		}
		
		public function insert($table,$td,$post){
			
			$start_table=$table; 
			$table=pre.$table;
			
			$mas_td=explode(',',$td);
			$count=count($mas_td);
			$line_1='';
			$line_2='';
			for ($i=0;$i<$count;$i++) {
				$line_1.='`'.$mas_td[$i].'`,'; 
				$line_2.='?,';
				if ($post[$i]=='') { $post[$i]=''; }
			}
			$line_1.='`time_create`,`time_update`';
			$line_2.='?,?'; 
			$post[$count]=date('Y-m-d H:i');
			$post[$count+1]=date('Y-m-d H:i');
			
			$sth = $this->link->prepare("INSERT INTO `".$table."` (".$line_1.") VALUES (".$line_2.")");
			$sth->execute($post);
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,"INSERT INTO `".$table."` (".$line_1.") VALUES (".$line_2.")",serialize($post),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				$this->last = $this->link->lastInsertId();
				return true;
			}
			
		}
		
		public function insert_free($string,$array){
			$sth = $this->link->prepare($string);
			$sth->execute($array);
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,$string,serialize($array),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				$this->last = $this->link->lastInsertId();
				return true;
			}
		}
		
		public function update($table,$update,$where,$post){
			
			$start_table=$table; 
			$table=pre.$table;
			
			$mas_update=explode(',',$update);
			$mas_where=explode(',',$where);
			$count=count($mas_update);
			$line_1='';
			for ($i=0;$i<$count;$i++) {
				$line_1.='`'.$mas_update[$i].'`=?,'; 
			}
			$line_1.='`time_update`=?';
			
			$count_2=count($mas_where);
			for ($i=0;$i<$count_2;$i++) {
				if ($i!=0) {
					$line_2.=' AND `'.$mas_where[$i].'`=? '; 
				} else {
					$line_2='`'.$mas_where[$i].'`=? '; 
				}
				$post[$count+$count_2-$i] = $post[$count+$count_2-$i-1];
			}
			
			$post[$count]=date('Y-m-d H:i');
			
			$sth = $this->link->prepare("UPDATE `".$table."` SET ".$line_1."  WHERE ".$line_2);
			$sth->execute($post);
			$this->select($table, 'time_update', array($post[$count]));
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,"UPDATE `".$table."` SET ".$line_1."  WHERE ".$line_2,serialize($post),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				return true;
			}
		}
		
		public function update_free($string,$array){
			$sth = $this->link->prepare($string);
			$sth->execute($array);
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,$string,serialize($array),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				return true;
			}
		}
		
		public function delete($table,$where,$post){
			$mas_where=explode(',',$where);
			
			$start_table=$table; 
			$table=pre.$table;
			
			$count_2=count($mas_where);
			for ($i=0;$i<$count_2;$i++) {
				if ($i!=0) {
					$line_2.=' AND `'.$mas_where[$i].'`=? '; 
				} else {
					$line_2='`'.$mas_where[$i].'`=? '; 
				}
			}
			
			$sth = $this->link->prepare("DELETE FROM `".$table."` WHERE ".$line_2);
			$sth->execute($post);
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,"DELETE FROM `".$table."` WHERE ".$line_2,serialize($post),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				return true;
			}
			
		}
		
		public function delete_free($string,$array){
			$sth = $this->link->prepare($string);
			$sth->execute($array);
			
			$error_array = $sth->errorInfo();
			if ($error_array[0].$error_array[1]!='0000') { 
				$sth = $this->link->prepare("INSERT INTO `".pre."error_log` (`title`,`who`,`pre`,`q`,`array`,`time_create`,`time_update`) VALUES (?,?,?,?,?,?,?)");
				$sth->execute(array($error_array[0].' '.$error_array[1].' '.$error_array[2],$GLOBALS['user']->user->id,pre,$string,serialize($array),date('Y-m-d H:i'),date('Y-m-d H:i')));
				return false;
			} else {
				return true;
			}
		}
		
	}
?>