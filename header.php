<?php
	include_once 'config.php';
	include_once 'authorization.php';
	if($authorization) 
	{ 
?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluide">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/user/main.php?login=<?php echo $authorization['user_login']; ?>"><b>forcefree.tk</b></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-3">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="javascript:window.location.reload()"><span class="fa fa-refresh"></span></a><li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle navbar-img" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <b><?php echo $authorization['user_name']; ?>  </b> 
              <i class="fa fa-bars"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a href="/user/main.php?login=<?php echo $authorization['user_login']; ?>"><i class="fa fa-home"></i> Ваш профиль</a></li>
                <li><a href="/user/setting.php?login=<?php echo $authorization['user_login']; ?>"><i class="fa fa-cog"></i> Настройки</a></li>
                
                <li role="separator" class="divider"></li>
                <li><a href="/exit.php"><i class="fa fa-times-circle"></i> Выйти</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <br>
    <br>
    
<?php
	}
	else
	{
?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluide">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><b>forcefree.tk</b></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-3">
          <ul class="nav navbar-nav navbar-right">
            
            
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <br>
    <br>
<?php
	}
?>