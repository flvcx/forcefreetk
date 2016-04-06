<?php 
	include_once 'config.php';
	if(!empty($_COOKIE['login']) AND !empty($_COOKIE['pass'])) 
		{ 
			// ищем пользователя в таблице user, mysql_real_escape_string используем как защиту от sql injection
			$search_user = mysql_query("SELECT * FROM `user` WHERE `user_login` = '".mysql_real_escape_string($_COOKIE['login'])."' 
				AND `user_pass` = '".mysql_real_escape_string($_COOKIE['pass'])."'");
			//пользователь найден его логин и пароль привязан к массиву $authorization 
			$authorization = (mysql_num_rows($search_user) == 1) ? mysql_fetch_array($search_user) : 0; 
		} 
	else 
		{ 
			$authorization = 0; 
		}
?>