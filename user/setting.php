<?php
	include_once '../config.php';
	include_once '../authorization.php';
	if ($authorization)
	{
		if(isset($_GET['login'])==$authorization['user_login']) 
		{
			$login=$_GET['login'];
			$search_ank=mysql_query("SELECT * FROM `user` WHERE `user_login` = '".$login."' ");
      $feed_ank=mysql_fetch_array($search_ank); 
	?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>forcefree.tk | Настройки</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include ("../header.php"); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <?php include "../user/left_menu.php"; ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
          <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#setting" data-toggle="tab"><b>Настройки</b></a></li>
            </ul>
          </div>
          <br>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="setting">
              	<div id="acordion" class="panel-group">
                	<div class="panel panel-success">
                    	<div class="panel heading">
                        	<h4 class="panel-title">
                            	<a class="btn btn-lg btn-success  btn-block text-center" href="#edit-anketa" data-parent="#acordion" data-toggle="collapse">Изменить анкету</a>
                        	</h4>
                    	</div>
                    	<div id="edit-anketa" class="panel-collapse collapse">
                        	<div class="panel-body">
                            	<form role="form" action="/user/setting/edit-ank.php?login=<?php echo $login; ?>" method="post">
                    				<div class="form-group">
                        				<label>E-mail:</label><br>
                        					<input type="email" class="form-control" name="email"  placeholder="admin@microb.com" required="required" value="<?php echo $feed_ank['user_email'] ?>">
                    				</div>
                    				<div class="form-group">
                        				<label>Имя:</label><br>
                        				<input type="text" class="form-control" name="name" placeholder="a-z, A-Z, 0-9" required="required" value="<?php echo $feed_ank['user_name'] ?>">
                    				</div>
                    				<div class="form-group">
                        				<label>Пол:</label><br>
                        				<select name="sex" class="form-control" size="1" placeholder="Выберите пол" required="required">
                          					<option value="Мужской">Мужской</option>
                          					<option value="Женский">Женский</option>
                        				</select>
                    				</div>
                    				<div class="form-group">
                        				<label>Дата рождения:</label><br>
                        				<input type="date" class="form-control" name="birthday_data" placeholder="YYYY-MM-DD" min="1900-01-01" value="<?php echo $feed_ank['user_birthday_data'] ?>">
                    				</div>
                    				<div class="form-group">
                        				<label>Страна:</label><br>
                        				<input type="text" class="form-control" name="country" placeholder="Ваша страна" value="<?php echo $feed_ank['user_country'] ?>">
                    				</div>
                    				<div class="form-group">
                        				<label>Город:</label><br>
                        				<input type="text" class="form-control" name="city" placeholder="Ваш город" value="<?php echo $feed_ank['user_city'] ?>">
                    				</div>
                    				<div class="form-group">
                        				<label>О себе:</label><br>
                        				<input  name="about" class="form-control" rows="5" wrap="hard" placeholder="Кратко о себе" value="<?php echo $feed_ank['user_about'] ?>"></input>
                    				</div>
                    
                    				<button type="submit" class="btn btn-danger btn-block">Изменить анкету</button>
                				</form>
                        	</div>
                    	</div>
                	</div>
                	<div class="panel panel-info">
                    	<div class="panel heading">
                        	<h4 class="panel-title">
                            	<a class="btn btn-lg btn-info  btn-block text-center" href="#edit-profile-picture" data-parent="#acordion" data-toggle="collapse">Загрузить фото профиля</a>
                        	</h4>
                    	</div>
                    	<div id="edit-profile-picture" class="panel-collapse collapse">
                        	<div class="panel-body">
                            	<form  enctype="multipart/form-data" action="/user/profile_picture/upload_profile_picture.php"  method="post">
  									<div class="form-group">
										<label>Выберите новое изображение профиля:</label><br>
										<br>
										<input  type="hidden" name="MAX_FILE_SIZE" value="300000"  />
  										<input  type="file" name="uploadFile" accept="image/*"/>
  										<br>
  										<button type="submit" class="btn btn-danger btn-block" name="upload">Изменить анкету</button>
  										<br>
  										<p>* Имя изображения должно быть подписано английскими буквами, цифрами</p>
  									</div>
  								</form>
                        	</div>
                    	</div>
                	</div>
            	</div>
            </div>
          </div>
        </div>
      </div>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.js"></script>
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

	<?php
		}
		else
		{
			echo '
			<script type="text/javascript">
			window.location.href="/index.php"
			</script>
			';
		}
  }
	else
	{
		echo '
			<script type="text/javascript">
			window.location.href="/index.php"
			</script>
			'; 
	}

?>