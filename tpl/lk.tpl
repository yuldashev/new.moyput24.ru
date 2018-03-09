<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{title}</title>
<base href="{base_url}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="{favicon}" type="image/png">
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/class.css" type="text/css" rel="stylesheet" />
{class_auto_css}
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script> 
<script type="text/javascript" src="js/function.js"></script> 
<script type="text/javascript" src="js/jquery.damnUploader.js"></script>
{class_auto_uniquejs}
{class_auto_js}
</head>
<body>
	{class_lk_testautorization}
	<div id="body">
		<div id="content">
			<div id="left">
				<div id="logo">
					<img src="images/logo.png" class="link" data-link="/">
				</div>
				<div id="menuIcon"><img src="images/menuIcon.png"></div>
				<div id="menu_block"></div>
				<div id="menu">
					<p class="menu_title">
						I ступень
					</p>
					<div class="menu_li hover link" data-link="/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_1.png"></p>
						<p class="menu_li_title">Личный кабинет</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link text" data-text="chat"><!--data-link="/chats/"--> 
						<p class="menu_li_ico"><img src="images/ico_l_menu_2.png"></p>
						<p class="menu_li_title">Написать куратору</p>
						<p class="menu_li_info">{class_chats_countnewcomments}</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="/progress/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_3.png"></p>
						<p class="menu_li_title">Прогресс</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="/fooddiaryscomments/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_4.png"></p>
						<p class="menu_li_title">Ответы на дневник питания</p>
						<p class="menu_li_info">{class_fooddiaryscomments_countnewcomments}</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="/before_days/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_5.png"></p>
						<p class="menu_li_title">Предыдущие дни</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="/questionnaires/">
						<p class="menu_li_ico"><img src="images/anketa.png"></p>
						<p class="menu_li_title">Анкета</p>
						<p class="clear"></p>
					</div>
					
					<p class="menu_line"></p>
					
					<p class="menu_title" style="margin-top:34px;">
						Полезное
					</p>
					<div class="menu_li hover link" data-link="/videos/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_6.png"></p>
						<p class="menu_li_title">Полезное видео</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="/vebinars/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_7.png"></p>
						<p class="menu_li_title">Вебинары</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="/all_articles/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_8.png"></p>
						<p class="menu_li_title">Статьи</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="/world_fooddiarys/">
						<p class="menu_li_ico"><img src="images/ico_l_menu_9.png"></p>
						<p class="menu_li_title">Мир дневников</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link text" data-text="recipes">
						<p class="menu_li_ico"><img src="images/ico_l_menu_10.png"></p>
						<p class="menu_li_title">Рецепты</p>
						<p class="clear"></p>
					</div>
					
					<p class="menu_line"></p>
					
					<p class="menu_title" style="margin-top:34px;">
						Прочее
					</p>
					<div class="menu_li hover link text" data-text="showcase">
						<p class="menu_li_ico"><img src="images/ico_l_menu_11.png"></p>
						<p class="menu_li_title">Витрина продуктов Мой Путь</p>
						<p class="clear"></p>
					</div>
					<div class="menu_li hover link" data-link="">
						<p class="menu_li_ico"><img src="images/ico_l_menu_12.png"></p>
						<a href="http://moyput24.ru/" target="_blank"><p class="menu_li_title" style="color:#4f4f4f;">Сайт школы</p></a>
						<p class="clear"></p>
					</div>
				</div>
			</div>
			<div id="right">
				<div id="system_info">{class_lk_info}</div>
				<div id="right_header">
					<div class="menu_top_li hover link" data-link="" id="menuIcon_psevdo">
						<p class="menu_top_ico"><img src="images/menuIcon.png"></p>
						<p class="menu_top_title"></p>
					</div>
					<div class="menu_top_li hover link" data-link="/pays/">
						<p class="menu_top_ico"><img src="images/ico_t_menu_1.png"></p>
						<p class="menu_top_title">Оплата</p>
					</div>
					<div class="menu_top_li hover text" data-text="faq">
						<p class="menu_top_ico"><img src="images/ico_t_menu_2.png"></p>
						<p class="menu_top_title">FAQ</p>
					</div>
					<div class="menu_top_li hover text" data-text="news">
						<p class="menu_top_ico"><img src="images/ico_t_menu_3.png"></p>
						<p class="menu_top_title">Новости</p>
					</div>
					<div class="menu_top_li hover text" data-text="stock">
						<p class="menu_top_ico"><img src="images/ico_t_menu_4.png"></p>
						<p class="menu_top_title">Акции</p>
					</div>
					<div class="menu_top_li hover text" data-text="programs">
						<p class="menu_top_ico"><img src="images/ico_t_menu_5.png"></p>
						<p class="menu_top_title">Магазин программ</p>
					</div>
					
					
					<div class="user_info">
						<p class="user_info_title link" data-link="/questionnaires/" style="cursor:pointer;">{class_lk_username}</p>
						<p class="user_info_ico link" data-link="/questionnaires/" style="cursor:pointer;">{class_lk_userface}</p>
						<p class="user_info_menu_ico"><img src="images/ico_down.png"></p>
						<p class="clear"></p>
						<div id="user_info_menu">
							<p class="user_info_menu_li hover" id="new_avatar">Изменить&nbsp;фото</p>
							<p class="user_info_menu_li hover ajax" data-ajax="/lk/outs/">Выход</p>
						</div>
					</div>
				</div>
				<div id="right_content">
					{class_auto_content}
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="footer">
		<p id="footer_menu">
			<center>
				<p class="footer_menu_li link" data-link="/">главная</p>
				<p class="footer_menu_li text" data-text="about">о программе</p>
				<p class="footer_menu_li text" data-text="help">помощь</p>
				<p class="footer_menu_li text" data-text="contact">обратная связь</p>
			</center>
		</p>
		<p id="footer_copy">
			Мой Путь &copy; 2017
		</p>
	</div>
</body>
</html>