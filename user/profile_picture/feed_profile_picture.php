<?php
	//получаем изображение профиля
	if(isset($_GET['login']))
  		{
  			$login=$_GET['login'];
  			
  			//проверяем есть ли изображение пользователя в БД
  			$sql_select_name_img = mysql_query("SELECT profile_picture FROM user WHERE `user_login` = '$login' ");
            $select_name_img=mysql_fetch_array($sql_select_name_img);
            if (!empty($select_name_img))
            {
                //берем имя текущего изображения профиля
                $feed_img_name = $select_name_img['profile_picture'];
                if (!empty($feed_img_name))
                {
                	//ссылка на изображение
                	$link_img = ('/user/profile_picture/img/'.$feed_img_name);
  					echo '<img src="'; echo "$link_img"; echo '" alt="profile picture" class="img-rounded img-responsive">';
                }
                else
                {
  					echo '<img src="/user/profile_picture/img/default_img.png" alt="default picture" class="img-rounded img-responsive">';
                }
            }
  		}
  		else
  		{
  			echo "Логин пользователя не передан - Изображение профиля не получено";
  		}