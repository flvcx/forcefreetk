<?php 
    include_once '../config.php';
    include_once '../authorization.php'; 

    if(isset($_GET['mess_id'])) 
		{
			$mess_id=$_GET['mess_id'];
			if ($authorization)
				{
					$search_mess=mysql_query("SELECT * FROM `mess` WHERE `mess_id` = $mess_id ");
					$mess_feed=mysql_fetch_array($search_mess);
					if ($mess_feed['user_login']==$authorization['user_login'])
					{
						$delete_mess = mysql_query("DELETE FROM `mess` WHERE `mess_id` = $mess_id ");
						if ($delete_mess)
						{
							echo '<script type="text/javascript">
                                window.location.href="/user/main.php?login='.$authorization['user_login'].'"
                        		</script>';
				
						}
						else
						{
							echo "Что-то пошло не так. Сообщение не удалено.";
						}
					}
					else
					{
						echo "Вы не можете удалять чужие сообщения.";
					}
				}
			else
				{
					echo "Для этого действия нужно авторизироваться.";
				}
		}
	else
	{
		echo "Вы не передали ID сообщения.";
	}