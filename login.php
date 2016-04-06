<?php
session_start ();
?>
<?php
    include_once 'config.php';
    include_once 'authorization.php'; 
	if($authorization) 
		{ 
			echo '
					<script type="text/javascript">
					window.location.href="/user/main.php?login='.$authorization['user_login'].'"
					</script>
				';   
			exit(); 
		}
	else
		{
			if(!empty($_GET['login']) AND !empty($_GET['pass'])) 
				{
					$login = mysql_real_escape_string(htmlspecialchars($_GET['login'])); 
					$pass = mysql_real_escape_string(htmlspecialchars(hash('ripemd128', $_GET['pass'])));
					$search_user = mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `user_login` = '".$login."' AND `user_pass` = '".$pass."'"), 0);
					if($search_user == 1) 
						{ 
							$time = 60*60*24; 
							setcookie('login', $login, time()+$time, '/'); 
							setcookie('pass', $pass, time()+$time, '/'); 
							echo '
								<script type="text/javascript">
									window.location.href="/login.php"
								</script>
							';   
							exit();
						} 
					else 
						{  
							$error = 'Логин или пароль введены не верно.';
						}
				} 
		}    
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
    <?php include ("header.php"); ?>

    <div class="container-fluid">
      <div class="row">
      	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      	</div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        	<h3>Вход</h3>
        	<hr>
            <form role="form" action="/login.php" method="get">
            <div class="form-group">
                <input type="login" name="login" pattern="^[a-zA-Z0-9]*"    placeholder="Введите логин" required="required" class="form-control" id="login">
            </div>
              <div class="form-group">
                  <input type="password" name="pass" pattern="^[a-zA-Z0-9]*"    placeholder="Введите пароль" required="required" class="form-control" id="pwd">
              </div>
            <button type="submit" class="btn btn-success btn-lg btn-block">Войти</button>
            <a class="btn btn-danger btn-lg btn-block" data-toggle="modal" href="#registration">Регистрация</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      	</div>
      </div>
    </div>
  

    <div class="modal fade" id="registration">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
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