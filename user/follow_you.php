<?php 
  if(isset($_GET['login'])) 
    {
      $login=$_GET['login'];
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
                <li class="active"><a href="#mess" data-toggle="tab"><b><?php echo $login; ?></b> читает:</a></li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="mess">
            <br>
              <?php include "../user/feed_follow_you.php"; ?>
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
  else
  {
  	echo "Не передан логин пользователя чьих подпищиков вы хотите просмотреть.";
  }
?>