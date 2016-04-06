<?php 
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
        $about_user_query_lm=mysql_query("SELECT * FROM `user` WHERE `user_login` = '".$login."' ");
        //выводим информацию о пользователе
        while($about_user_lm=mysql_fetch_array($about_user_query_lm)) 
        {
?>
<div class="container-fluide">
    <div class="row">
            <div class="well">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php
                          include '../user/profile_picture/feed_profile_picture.php';
                        ?>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <h3 class="text-center"><a href="/user/main.php?login=<?php echo $about_user_lm['user_login']; ?>"><?php echo $about_user_lm['user_name']; ?></a></h3>
                        <small><cite><?php echo $about_user_lm['user_city']; ?>, <?php echo $about_user_lm['user_country']; ?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?php echo $about_user_lm['user_email']; ?>
                            <br/>
                            <i class="glyphicon glyphicon-gift"></i><?php echo $about_user_lm['user_birthday_data']; ?>
                        </p>
                    </div>
                    <div class="btn-group btn-group-justified">
                      <a class="btn btn-default btn-block text-center" href="/user/follow_you.php?login=<?php echo $login; ?>"><span class="fa fa-user-plus fa-3"></span> Читает</a>
                      <?php 
                        if ($login!=$authorization['user_login'])
                        {
                          include "../user/href_follow.php"; 
                        }
                      ?>
                      <a href="../user/about_user.php?login=<?php echo $login; ?>" class="btn btn-info"><span class="fa fa-newspaper-o fa-3"></span> Анкета</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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