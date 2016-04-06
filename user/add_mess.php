<?php
	include_once '../config.php';
	include_once '../authorization.php';  
	if($login==$authorization['user_login'])
	{
		if (!empty($_POST['add_mess']))
		{
			$add_mess=mysql_real_escape_string(htmlspecialchars($_POST['add_mess']));
			$mess_data=date("Y-m-d H:i:s");
			//проверяем длинну переданного сообщения
			if (mb_strlen($add_mess)<255)
			{
				$mess_add_to_db=mysql_query("INSERT INTO `mess` (
													`user_login`,
													`mess_messeg`,
													`mess_data`
												) 
													VALUES ('".$authorization['user_login']."',
															'".$add_mess."', 
															'".$mess_data."'
															)"
							);
				if ($mess_add_to_db)
					{
						echo '
                			<script type="text/javascript">
                			window.history.go(-1)
                			</script>
                			'; 
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
										<textarea name="add_mess" placeholder="Введите текст нового сообщения..." ></textarea>
										<button type="submit" class="btn btn-success green"><b>Отправить</b></button>
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