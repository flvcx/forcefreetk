<?php  
	if($authorization['user_login'])
	{
		if (!empty($_POST['add_comm']))
		{
			$add_comm=mysql_real_escape_string(htmlspecialchars($_POST['add_comm']));
			$comm_data=date("Y-m-d H:i:s");
			//проверяем длинну переданного сообщения

			if (strlen($add_comm)<255)
			{
				$comm_add_to_db=mysql_query("INSERT INTO `comment` 
												(
													`comm_data`,
													`mess_id`,
													`user_login`,
													`comm_messeg`
												) 
											VALUES (
														'".$comm_data."',
														'".$mess_id."',
														'".$authorization['user_login']."',
														'".$add_comm."'
													)
											
											"
							);
				if ($comm_add_to_db)
					{
						echo '
							<script type="text/javascript">
							window.location.href="/user/comment_reply.php?mess_id='.$mess_id.'&login='.$login.'"
							</script>
						'; 
						exit();
					}
			}
			else
			{
				echo "Текст сообщения не должен превышать 255 символов.";
			}
		}
?>
<html>
<div class="container-fluid">
    <div class="row">
    
    <div class="col-md-13">
    						<div class="widget-area no-padding blank">
								<div class="status-upload">
									<form action="" method="post">
										<textarea name="add_comm" placeholder="Введите текст комментария..." ></textarea>
										<button type="submit" class="btn btn-success green"><b>Отправить комментарий</b></button>
									</form>
								</div><!-- Status Upload  -->
							</div><!-- Widget Area -->
						</div>
        
    </div>
</div>
<br>
</html>
<?php
	} 

?>