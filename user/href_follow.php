<?php 
	//ссылка "Читать" или "Читаю"
	if(isset($_GET['login'])) 
		{
			$login=$_GET['login'];
			if ($authorization)
			{
				//проверяем существует ли пользователь переданный в $login 
				$search_user = mysql_query("SELECT * FROM `user` WHERE `user_login` = '".$login."' ");
				$user = (mysql_num_rows($search_user) == 1) ? mysql_fetch_array($search_user) : 0;
				if ($user)
				{
					//проверяем читает ли авторизированный пользователь переданного пользователя в $login 
					$search_follow = mysql_query("SELECT * FROM `follow` WHERE `follow_login` = '".$login."' ");
					$follow = (mysql_num_rows($search_follow) == 1) ? mysql_fetch_array($search_follow) : 0;
					if ($follow)
					{
						//если пользователь есть в таблице
?>
						<html>
							<a class="btn btn-success" href="/user/follow.php?login=<?php echo "$login"; ?>"><span class="fa fa-minus fa-3"></span> Читаю</a>
						</html>
<?php
					} 
					else
					{
						//если нет
?>
						<html>
							<a class="btn btn-success" href="/user/follow.php?login=<?php echo "$login"; ?>"><span class="fa fa-plus fa-3"></span> Читать</a>
						</html>
<?php
					}
				}
			}
			else
			{
				
			}
		}
?>