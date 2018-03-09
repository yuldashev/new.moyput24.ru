<?php
	class pays_view extends view{
		
		public function content($data){
			$this->html='<h2>Оплата</h2>';
			$this->html.='<div><table style="width:100%;"><tr><td text-valign="top"><div style=" background:#f5f5f5; margin-right:40px;"><span style="margin:20px 0 20px 20px;padding-right:20px;border-right:1px solid #c4c4c4; display:inline-block;"><b>Число:</b><br><br>'.date('d.m.Y',$data[count($data)-2]['start']).'</span><span style="padding-left:20px; margin:20px 20px 20px 0; background:#f5f5f5; display:inline-block; "><b>До:</b><br><br>'.date('d.m.Y',$data[count($data)-2]['finish']).'</span></div><p style="margin-top:40px;">По всем вопросам оплаты пишите в сообщение группы: <a href="http://vk.me/moyputschool" target="_blank" style="color:#458cb5;">vk.me/moyputschool</a></p></td><td style="width:245px;"><div style="width:245px; height:120px; padding:20px 0;border:1px solid #cfcfcf; border-radius:3px; text-align:center;"><p><b>Осталось дней:</b></p><p style="margin-top:25px; font-size:54px;">'.$data['ost_days'].'</p></div></td></tr></table></div><div class="clear"></div>';
			$this->html.='<p style="background:#c4c4c4;height:1px;margin:20px 0;"></p>';
			
			$this->html.='<table style="width:100%;"><tr><td style="width:25%; padding:20px 5px; text-align:center;"><b>Доплатить<br>недельный курс</b><button class="button_green link" data-link="http://paymentgateway.ru/?project=8805&amount=400&nickname=2_'.$GLOBALS['user']->user->id.'" style="margin-top:20px;">400 рублей</button></td><td style="width:25%; padding:20px 5px; text-align:center;"><b>Оплатить<br>1000 рублей</b><button class="button_green link" data-link="http://paymentgateway.ru/?project=8805&amount=1000&nickname=2_'.$GLOBALS['user']->user->id.'" style="margin-top:20px;">1000 рублей</button></td><td style="width:25%; padding:20px 5px; text-align:center;"><b>Продлить<br>до 30 дня</b><button class="button_green link" data-link="http://paymentgateway.ru/?project=8805&amount=2610&nickname=2_'.$GLOBALS['user']->user->id.'" style="margin-top:20px;">2610 рублей</button></td><td style="width:25%; padding:20px 5px; text-align:center;"><b>Продлить<br>до 60 дня</b><button class="button_green link" data-link="http://paymentgateway.ru/?project=8805&amount=5600&nickname=2_'.$GLOBALS['user']->user->id.'" style="margin-top:20px;">5600 рублей</button></td></tr></table>';
			
			return $this->html;
		}
		
	}
?>