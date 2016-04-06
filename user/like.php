<?php 
	include_once '../config.php';
	include_once '../authorization.php'; 
	//добавление удаление лайков
	if(isset($_GET['mess_id'])) 
		{
			$mess_id=$_GET['mess_id'];
			if ($authorization)
			{
				//$ = mysql_query("SELECT mess WHERE mess_id='".$mess_id."' ");
				$search_mess=mysql_query("SELECT * FROM mess WHERE mess_id = '".$mess_id."' ");
				while ($mess=mysql_fetch_array($search_mess)) 
				{
					$search_like = mysql_query("SELECT * FROM `like` WHERE `like_login` = '".$authorization['user_login']."' && `mess_id` = '".$mess_id."' ");
					$like = (mysql_num_rows($search_like) == 1) ? mysql_fetch_array($search_like) : 0;
					if ($like)
					{
						$delete_like = mysql_query("DELETE FROM `like` WHERE `like_login` = '".$authorization['user_login']."' ");
						header("Location: ".$_SERVER['HTTP_REFERER']);
					}
					else
					{
						$add_follow = mysql_query("INSERT INTO `like` (`like_login`,`mess_id`)
												   VALUES ('".$authorization['user_login']."', '".$mess_id."')
												");
						header("Location: ".$_SERVER['HTTP_REFERER']);
					}
				}
			}
			else
			{
				echo "Вы не авторизированы.";
			}
		}
	else
		{
			echo "id сообщение не передан.";
		}
?>