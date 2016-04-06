<?php 
	include_once '../config.php';
	include_once '../authorization.php'; 
	//дабавляться и удалятся со списка читателей пользователя
	if(isset($_GET['login'])) 
		{
			$login=$_GET['login'];
			if ($authorization['user_login']==$login) 
			{
				echo "Вы неможете читать самого себя.";
				exit();
			}
			elseif ($authorization)
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
						//если пользователь есть в таблице мы его удаляем
						$delete_follow = mysql_query("DELETE FROM `follow` WHERE `follow_login` = '".$login."' ");
						echo '<script type="text/javascript">
								window.location.href="/user/main.php?login='.$login.'"
							  </script>';
					} 
					else
					{
						//если нет добавляем
						$follow_data = date("Y.m.d");
						$add_follow = mysql_query("INSERT INTO `follow` (`user_login`,`follow_login`, `follow_data`)
												   VALUES ('".$authorization['user_login']."', '".$login."', '".$follow_data."')
												");
						echo '<script type="text/javascript">
								window.location = history.go(-1);
							  </script>';
					}
				}
				else
				{
					echo "Пользователь не найден";
				}
			}
			//else
			//{
			//	echo "Для этого действия нужно авторизироваться.";
			//}
		}
?>