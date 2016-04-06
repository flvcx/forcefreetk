<?php 
  function getUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
} 
?>
<br>
<br>
<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-1  col-md-1 col-sm-1">
            </div>
        	<div class="col-lg-3  col-md-3 col-sm-3">
            	<div class="footer_dv">
                	<h4>Операции</h4>
                	<ul>
<?php if (!$authorization)
{
?>
                    	<li><a class="link_footer" href="/login.php">Войти</a></li>
                        <li><a class="link_footer" href="/reg.php">Зарегистрироваться</a></li>
<?php                        
  }
	else
{
	echo '<li><a class="link_footer" href="/exit.php">Выйти</a></li>';
}
?>                    
			    <p class="text-muted">
                            <b>forcefree.tk</b>
                            <br>Сайт был разработан 
                            <br>в качестве курсового проекта.
                            <br>
                        </p>
                        <p class="text-primary">
                            <a href="/user/main.php?login=admin"><b>2016 <i class="fa fa-copyright"></i> Дмитрий Скибицкий</b></a>
                        </p>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5  col-md-5 col-sm-5">
            	<div class="footer_dv">
                	<h4 class="text-center">Вы нашли ошибку?</h4>
                	<ul>
                    	<form role="form" action="/error.php" method="post">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Введите Ваш E-mail" required="required" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <input type="text" name="url" placeholder="Введите адрес страницы на которой замечена ошибка" required="required" class="form-control" id="url" value="<?php echo getUrl(); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="about_error" placeholder="Опишите ошибку" required="required" class="form-control" id="about">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg btn-block">Отправить</button>
                        </form>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3  col-md-3 col-sm-3">
                <br>
                <br>
                    <ul class="social">
                        <li class="facebook2"><a target="_blank" href="https://vk.com/flvcx"><i class="fa fa-vk fa-3x"></i></a></li>
                        <li class="twitter2"><a target="_blank" href="https://github.com/flvcx"><i class="fa fa-github fa-3x"></i></a></li>
                        <li class="behance3"><a target="_blank" href="mailto:lunarc@mail.ru?subject=Отправлено с force.free"><i class="fa fa-envelope-o fa-3x"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>