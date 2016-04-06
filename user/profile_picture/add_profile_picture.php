<?php 
	include_once '../../config.php';
	include_once '../../authorization.php'; 
	//ссылка "Читать" или "Читаю"
	if ($authorization)
		{
?>
				<form  enctype="multipart/form-data" action="/user/profile_picture/upload_profile_picture.php"  method="post">
  					<input  type="hidden" name="MAX_FILE_SIZE" value="300000"  />
  					<input  type="file" name="uploadFile" accept="image/*,image/jpeg"/>
  					<input  type="submit" name="upload" value="Загрузить"/>
  				</form>
<?php
		}
	else
		{
			echo "Вы не авторизировались.";
		}
?>