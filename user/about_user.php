<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>forcefree.tk | О пользователе | <?php $login ?></title>

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
    <?php include ("../header.php"); 
    
                                if(isset($_GET['login'])) 
                                {
                                    $login=$_GET['login'];
                                    //  ищем есть ли пользователь
                                    $search_user = mysql_query("SELECT * FROM `user` WHERE `user_login` = '".$login."' ");
                                    $user = (mysql_num_rows($search_user) == 1) ? mysql_fetch_array($search_user) : 0;
                                    //пользователь найден
                                    if ($user)
                                    {
                                        //вытаскиваем информацию о пользователе
                                        $about_user_query=mysql_query("SELECT * FROM `user` WHERE `user_login` = '".$login."' ");
                                        //выводим информацию о пользователе
                                        while($about_user=mysql_fetch_array($about_user_query)) 
                                        {
                        
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <?php
                include "../user/left_menu.php";
            ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <h3>О пользователе</h3>
        <hr>
        <div class="container-fluide">
			<div class="row">
    	 		<div class="well profile">
            		<div class="col-sm-12">
                		<div class="col-xs-12 col-sm-8">
                            
                    		<h2><a href="/user/main.php?login=<?php echo $login; ?>"><?php echo $login; ?></a></h2>
                    		<hr>
                    		<p><strong>Логин: </strong> <?php echo $about_user['user_login']; ?> </p>
                    		<p><strong>Имя: </strong> <?php echo $about_user['user_name']; ?> </p>
                    		<p><strong>Пол: </strong> <?php echo $about_user['user_sex']; ?> </p>
                    		<p><strong>E-mail: </strong> <?php echo $about_user['user_email']; ?> </p>
                    		<p><strong>Дата рождения: </strong> <?php echo $about_user['user_birthday_data']; ?> </p>
                    		<p><strong>Страна: </strong> <?php echo $about_user['user_country']; ?> </p>
                    		<p><strong>Город: </strong> <?php echo $about_user['user_city']; ?> </p>
                    		<p><strong>О себе: </strong> <?php echo $about_user['user_about']; ?> </p>
                    		<p><strong>Дата регистрации: </strong> <?php echo $about_user['user_data_reg']; ?> </p>

                		</div>             
                		<div class="col-xs-12 col-sm-4 text-center">
                    		<figure>
                        		<?php include "../user/profile_picture/feed_profile_picture.php"; ?>
                    		</figure>
                		</div>
            		</div>            
            		<div class="col-xs-12 divider text-center">
                		<div class="col-xs-12 col-sm-12 emphasis">                  
                    		<a href="/user/main.php?login=<?php echo $login; ?>" class="btn btn-lg btn-info btn-block"><span class="fa fa-user"></span>Личная страница</a>
                		</div>
            		</div>
            	</div>
    	 	</div>                 
		</div>
	</div>
    </div>
    </div>
    <?php include_once "../footer.php";?> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.js"></script>
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
  </body>
</html>
<?php
				}
			}
			elseif (empty($login))
			{
				echo "Логин пользователя не указан.";
			}
			else
			{
				echo "Пользоватль не найден.";
			}

		}
	
?>