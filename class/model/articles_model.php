<?php
	class articles_model extends model{
		
		public function content_articles($data){
			$articles=new article();
			$days=new days();
			if ($days->test_rules($data['get']['id'])) {
				$article=$articles->getarticle($data['get']['id']);
				
				if ($article['error']) {
					$this->data['error']='1'; // Ошибка есть
					$this->data['result']=$article['result']; // Выводим причину
				} else {
					$this->data['error']='0'; // Ошибки нет
					$this->data['result']=$article['result']; // Выводим причину
				}
				//$this->data['setread']=$days->setread($data['get']['id']);
			} else {
				$this->data['error']='1'; // Ошибка есть
				$this->data['result']='Статья недоступна'; // Выводим причину
			}
			return $this->data;
		}
		
		public function all_articles(){
			$articles=new article();
			$all_articles=$this->get_all_id("Статья");
			$this->data['error']='0'; // Ошибки нет
			for($i=0;$i<count($all_articles);$i++){
				$this->data['result'][]=array('stat'=>$articles->getarticlepre($all_articles[$i]['id']),'day'=>$all_articles[$i]['day']); // Формируем список статей
			}
			return $this->data;
		}
	}
?>