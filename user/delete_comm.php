<?php 
    include_once '../config.php';
    include_once '../authorization.php'; 

    if(isset($_GET['comm_id'])) 
		{
			$comm_id=$_GET['comm_id'];
			if ($authorization)
				{
					$search_comm=mysql_query("SELECT * FROM `comment` WHERE `comm_id` = $comm_id ");
					$comm_feed=mysql_fetch_array($search_comm);
					if ($comm_feed['user_login']==$authorization['user_login'])
					{
						$delete_comm = mysql_query("DELETE FROM `comment` WHERE `comm_id` = $comm_id ");
						if ($delete_comm)
						{
							header("Location: ".$_SERVER['HTTP_REFERER']); 
						}
						else
						{
							echo "Что-то пошло не так. Ответ не удалено.";
						}
					}
					else
					{
						echo "Вы не можете удалять чужие ответы.";
					}
				}
			else
				{
					echo "Для этого действия нужно авторизироваться.";
				}
		}
	else
	{
		echo "Вы не передали ID ответа.";
	}