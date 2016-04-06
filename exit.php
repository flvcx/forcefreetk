<?php 
	include_once 'config.php';
	include_once 'authorization.php';
	//проверяем авторизирован ли пользователь
	if($authorization) 
		{ 
			setcookie('login', '', time()-1, '/'); 
			setcookie('pass', '', time()-1, '/'); 
			session_start();
			session_destroy(); 
			header ('Location: /index.php');	
			exit();  
		}
	//если не авторизирован 
	else 
		{ 
			echo '
					<script type="text/javascript">
						window.location.href="/index.php"
					</script>
				';
		} 
?>