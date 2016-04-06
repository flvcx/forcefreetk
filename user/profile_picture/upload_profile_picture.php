<?php
	include_once '../../config.php';
	include_once '../../authorization.php'; 
	//загружает изображение профиля
		function generateImgName($length)
		{
  			$chars = 'abdefhiknrstyz0123456789';
  			$numChars = strlen($chars);
  			$stringimg = '';
  			for ($i = 0; $i < $length; $i++) 
  			{
    			$stringimg .= substr($chars, rand(1, $numChars) - 1, 1);
  			}
  			return $stringimg;
		}

	if ($authorization)
		{ 
		    if(isset($_POST['upload']))
  			{
          $folder = '../../user/profile_picture/img/';
  				$uploadedFileName = generateImgName (5).basename($_FILES['uploadFile']['name']);
          $uploadedFile = $folder.$uploadedFileName;
  				if (is_uploaded_file($_FILES['uploadFile']['tmp_name']))
  				{

  					if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadedFile))
  					{
              $autho = $authorization['user_login'];
  						$sql_select_name_img = mysql_query("SELECT profile_picture FROM user WHERE `user_login` = '$autho' ");
              $select_name_img=mysql_fetch_array($sql_select_name_img);
              //проверяем есть ли изображение пользователя в БД
              if (!empty($select_name_img))
              {
                //берем имя текущего изображения профиля
                $delete_old_img = $select_name_img['profile_picture'];
                //передаем на удаление
                $to_delete = unlink('../../user/profile_picture/img/'.$delete_old_img);
              }
              //добавляем название изображения в бд
              $sql_insert_name_img = mysql_query("UPDATE user SET profile_picture='$uploadedFileName' WHERE user_login='$autho' ") or die (mysql_error());
              if ($sql_insert_name_img)
              {
                echo '
                <script type="text/javascript">
                window.location.href="/user/setting.php?login='.$authorization['user_login'].'"
                </script>
                ';
              }
  					}
  				}
  			}
	  }
?>