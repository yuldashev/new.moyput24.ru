<?php
	class chats_view extends view{
	
		public function content($data){
			$this->html='<h2>Написать куратору</h2>';
			$this->html.='<div id="chat_body"><div>';
			for($i=0;$i<$data->count;$i++){
				if ($data->rows[$i]->type=='0') {
					$this->html.='<div style="width:70%;float:left;margin:20px; overflow:visible; "><p style="font-size:13px;margin-bottom:15px;">Куратор <span style="color:#aaa;">'.$data->rows[$i]->time_create.'</span></p><div style="-webkit-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.3); -moz-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.3); box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.3); padding:15px; border-radius:3px; font-size:14px;">'.$data->rows[$i]->body.'</div></div><div class="clear"></div>';
				} else {
					$this->html.='<div style="width:70%;float:right;margin:20px; overflow:visible;"><p style="font-size:13px;margin-bottom:15px;">'.$GLOBALS['user']->user->client[0].' '.$GLOBALS['user']->user->client[1].' <span style="color:#aaa;">'.$data->rows[$i]->time_create.'</span></p><div style="-webkit-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.3); -moz-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.3); box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.3); padding:15px; border-radius:3px; font-size:14px;">'.$data->rows[$i]->body.'</div></div><div class="clear"></div>';
				}
			}
			$this->html.='</div></div>';
			$this->html.='<textarea class="input" placeholder="Напишите сообщение" id="new_message" style="width: calc(100% - 22px); width: -moz-calc(100% - 22px); width: -webkit-calc(100% - 22px); width: -o-calc(100% - 22px); height: 100px;"></textarea><button class="button_green" id="new_chat_message">Отправить</button>';
			return $this->html.'<script>$(function(){ $("#chat_body").scrollTop($("#chat_body").children("div").height()); $("#new_chat_message").click(function(){ if (required(["#new_message"])) { auto_ajax("/chats/new_chat_message/",{"message":$("#new_message").val()}); } }); })</script>';
		}
		
		public function new_chat_message($data){
			return '<script>$(function(){ go("/chats/","0"); })</script>';
		}		
		
		public function countnewcomments($data){
			if ($data>0) { return '<span>'.$data.'</span>'; } else { return ''; }
		}
	}
?>