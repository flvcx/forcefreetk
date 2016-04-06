<?php
session_start ();
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>forcefree.tk</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include "header.php"; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
          <form role="form" action="/login.php">
            <div class="form-group">
              <label for="login">Логин:</label>
                <input type="login" name="login" pattern="^[a-zA-Z0-9]*"    placeholder="Введите логин" required="required" class="form-control" id="login">
            </div>
              <div class="form-group">
                <label for="pwd">Пароль:</label>
                  <input type="password" name="pass" pattern="^[a-zA-Z0-9]*"    placeholder="Введите пароль" required="required" class="form-control" id="pwd">
              </div>
            <button type="submit" class="btn btn-success btn-lg btn-block">Войти</button>
            <a class="btn btn-danger btn-lg btn-block" data-toggle="modal" href="#registration">Регистрация</a>
          </form>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        	<?php
			include_once 'config.php';
			include_once 'authorization.php'; 
			//файл регистрации пользователя
			//если пользователь авторизирован
			if($authorization)
				{
					echo '
							<script type="text/javascript">
							window.location.href="/user/main.php?login='.$authorization['user_login'].'"
							</script>
					'; 
				} 
				//пользователь не авторизирован
        	else 
			{
				//обрабатываем данные с формы регистрации
					if (!empty($_POST['login'])&&
					!empty($_POST['pass'])&&
					!empty($_POST['email'])&&
					!empty($_POST['name'])&&
					!empty($_POST['sex']))
					{
					$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
					$password = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
					$pass = hash('ripemd128', $password); 
					$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
					$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
					$sex = mysql_real_escape_string(htmlspecialchars($_POST['sex']));
					$birthday_data = mysql_real_escape_string(htmlspecialchars($_POST['birthday_data']));
					$country = mysql_real_escape_string(htmlspecialchars($_POST['country']));
					$city = mysql_real_escape_string(htmlspecialchars($_POST['city']));
					$data_reg = date("Y.m.d");
					$about = mysql_real_escape_string(htmlspecialchars($_POST['about']));
					//счетчик ошибок
					$error = 0;
					$search_login_in_db=mysql_query("SELECT * FROM `user` WHERE `user_login` = '".$login."' ");
					$search_login=mysql_fetch_array($search_login_in_db);
					$search_email_in_db=mysql_query("SELECT * FROM `user` WHERE `user_login` = '".$email."' ");
					$search_email=mysql_fetch_array($search_email_in_db);
					$error_mess[7];					
					if ($login == $search_login['user_login'] || $email == $search_email['user_email'])
					{
						$error++;
						echo '<div class="alert alert-danger" role="alert">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>';
  						echo "Логин или E-Mail уже зарегистрированы";
						echo '
						</div>
						<br>
						';
					}
					if (mb_strlen($login)>16||mb_strlen($login)<3)
					{
						$error++;
						echo '<div class="alert alert-danger" role="alert">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>';
  						echo "Логин не долшен превышать 16 символов и не должен быть меньше 3 символов.";
						echo '</div>
						<br>';
					}
					if (mb_strlen($pass)>32)
					{
						$error++;
						echo '<div class="alert alert-danger" role="alert">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>';
  						echo "Пароль не долшен превышать 32 символов и быть меньше 6 символов.";
						echo '</div>
						<br>';
					}
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
					if (mb_strlen($name)>50||mb_strlen($name)<3)
					{
						$error++;
						echo '<div class="alert alert-danger" role="alert">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>';
						echo "Имя - поле не должно превышать 16 символов и быть не меньше 3 символов.";
						echo '</div>
						<br>';
					}
					if (mb_strlen($country)>32)
					{
						$error++;
						echo '<div class="alert alert-danger" role="alert">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>';
						echo "Страна - поле не должно превышать 32.";
						echo '</div>
						<br>';
					}
					if (mb_strlen($city)>32)
					{
						$error++;
						echo '<div class="alert alert-danger" role="alert">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>';
						echo "Город - поле не должно превышать 32 символов.";
						echo '</div>
						<br>';
					}
					if (mb_strlen($about)>120)
					{
						$error++;
						echo '<div class="alert alert-danger" role="alert">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>';
						echo "О себе - поле не должно превышать 120 символов.";
						echo '</div>
						<br>';
					}
					if ($error>0)
					{
						exit();
					}
					//ошибок не обнаружено
					else 
					{
						//запись данных о пользователе в бд
						mysql_query("INSERT INTO `user` (
															`user_login`,
															`user_pass`,
															`user_email`,
															`user_name`,
															`user_sex`,
															`user_birthday_data`,
															`user_country`,
															`user_city`,
															`user_data_reg`,
															`user_about`
															) VALUES ('".$login."',
																	'".$pass."', 
																	'".$email."', 
																	'".$name."', 
																	'".$sex."', 
																	'".$birthday_data."', 
																	'".$country."', 
																	'".$city."',
																	'".$data_reg."',  
																	'".$about."')"
									);
						 echo '
						 	<div class="alert alert-success" role="alert">
  							<i class="fa fa-chevron-down"></i>
  							Регистрация прошла успешно.
							<br>
							Можете приступать к авторизации на сайте.
							</div>
						 '; 
					}
				}
			}
        	?>
        </div>
      </div>
    </div>
  

    <div class="modal fade" id="reg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                    <h4 class="modal-title">Форма регистрации</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="/reg.php" method="post">
                    <div class="form-group">
                        <label>* Логин:</label><br>
                        <input type="text" class="form-control" name="login" pattern="^[a-zA-Z0-9]*"    placeholder="Введите логин" required="required">
                    </div>
                    <div class="form-group">
                        <label>* Пароль:</label><br>
                        <input type="password" class="form-control" name="pass" pattern="^[a-zA-Z0-9]*"    placeholder="Введите пароль" required="required">
                    </div>
                    <div class="form-group">
                        <label>* E-mail:</label><br>
                        <input type="email" class="form-control" name="email"  placeholder="admin@microb.com" required="required">
                    </div>
                    <div class="form-group">
                        <label>* Имя:</label><br>
                        <input type="text" class="form-control" name="name" placeholder="a-z, A-Z, 0-9" required="required">
                    </div>
                    <div class="form-group">
                        <label>* Пол:</label><br>
                        <select name="sex" class="form-control" size="1" placeholder="Выберите пол" required="required">
                          <option value="Мужской">Мужской</option>
                          <option value="Женский">Женский</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Дата рождения:</label><br>
                        <input type="date" class="form-control" name="birthday_data" placeholder="YYYY-MM-DD" min="1900-01-01">
                    </div>
                    <div class="form-group">
                        <label>Страна:</label><br>
                        <input type="text" class="form-control" name="country" placeholder="Ваша страна">
                    </div>
                    <div class="form-group">
                        <label>Город:</label><br>
                        <input type="text" class="form-control" name="city" placeholder="Ваш город">
                    </div>
                    <div class="form-group">
                        <label>О себе:</label><br>
                        <textarea name="about" class="form-control" rows="5" wrap="hard" placeholder="Кратко о себе"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-lg btn-block">Зарегистрироваться</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                    Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <script>
        $(function()
         {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        }
         )  
    </script>
  </body>
</html>