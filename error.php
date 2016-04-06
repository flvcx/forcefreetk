<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.js"></script>
    <script>
        $(function()
         {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        }
         )  
    </script>
<?php
	include_once 'config.php';
	include ("header.php");
	if (!empty($_POST['email'])&&!empty($_POST['url'])&&!empty($_POST['about_error']))
	{
		$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
		$url = mysql_real_escape_string(htmlspecialchars($_POST['url']));
		$about_error = mysql_real_escape_string(htmlspecialchars($_POST['about_error']));
		$error = 0;
		if (mb_strlen($email)>255||mb_strlen($email)<5)
		{
			$error++;
			echo '<div class="alert alert-danger" role="alert">
  			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  			<span class="sr-only">Error:</span>';
			echo "E-Mail - поле не должно превышать 255 символов и быть меньше 5 символов.";
			echo '</div>
			<br>';
		}
		if (mb_strlen($url)<5&&mb_strlen($url)>60)
			{
				$error++;
				echo '<div class="alert alert-danger" role="alert">
  				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  				<span class="sr-only">Error:</span>';
				echo "URL - поле не должно быть меньше 5 символов и больше 60 символов.";
				echo '</div>
				<br>';
			}
		if (mb_strlen($about_error)>=500)
			{
				$error++;
				echo '<div class="alert alert-danger" role="alert">
  				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  				<span class="sr-only">Error:</span>';
				echo "Опишите ошибку - поле не должно превышать 500 символов.";
				echo '</div>
				<br>';
			}
		if ($error>0)
			{
				echo '<div class="alert alert-danger" role="alert">';
				echo "Перезагрузка на предыдущую страницу через 5 сек.";
				echo '
				<script type="text/javascript">
				setTimeout(function(){history.go(-1);}, 5000);
				</script>
				';
				exit();
			}
			else
			{
				mysql_query("INSERT INTO `error` (`error_email`,
												`error_url`,
												`error_about`
												)
										VALUES ('".$email."',
											'".$url."',
											'".$about_error."'
											)

							");
				echo '
					<div class="alert alert-success" role="alert">
  					<i class="fa fa-chevron-down"></i>
  					Вы отправили сообщение об ошибке. В скоре администрация сайта его рассмотрит.
					<br>
					Перезагрузка на предыдущую страницу через 5 сек..
					</div>
					<script type="text/javascript">
					setTimeout(function(){history.go(-1);}, 5000);
					</script>
					'; 
			}
	}
	else
	{
		header("Location: '".$_SERVER['HTTP_REFERER']."' "); 
	}