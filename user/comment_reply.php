<?php 
	 
	if(isset($_GET['mess_id'])&isset($_GET['login'])) 
		{
			$mess_id=$_GET['mess_id'];
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
    <?php 
      include ("../header.php"); 
      $search_mess=mysql_query("SELECT * FROM `mess` WHERE `mess_id` = '".$mess_id."' ");
      $mess_feed=mysql_fetch_array($search_mess);
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <?php include "../user/left_menu.php"; ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
          <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#reply_comment" data-toggle="tab"><b>Сообщение</b></a></li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="reply_comment">
            <br>
                <section class="comment-list">
                                <article class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <a href="/user/main.php?login=<?php echo $mess_feed['user_login']; ?>"><?php
                                                include '../user/profile_picture/feed_profile_picture.php';
                                            ?>
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user">
                                                        <i class="fa fa-user"></i>
                                                            <a href="/user/main.php?login=<?php echo $mess_feed['user_login']; ?>">
                                                                <?php echo $mess_feed['user_login']; ?>
                                                            </a>
                                                    </div>
                                                        <time class="comment-date"><i class="fa fa-clock-o"></i><?php echo $mess_feed['mess_data']; ?></time>
                                                </header>
                                                <div class="comment-post">
                                                    <hr>
                                                    <p>
                                                        <?php 
                                                            echo $mess_feed['mess_messeg']; 
                                                        ?>
                                                    </p>
                                                    <hr>
                                                </div>
                                                <p class="text-right">
                                                <?php
                                                    include "../user/href_like.php";                   
                                                if ($_COOKIE['login'] == $mess_feed['user_login'])
                                                {

?>
                                                <a href="/user/delete_mess.php?mess_id=<?php echo $mess_feed['mess_id']; ?>" class="btn btn-danger" data-toggle="tooltip" title data-original-title="Удалить сообщение">
                                                    <i class="fa fa-times"></i>
<?php
                                                }
?>
                                                </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
              </section>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 hidden-xs">
                
              </div>
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 hidden-xs">
                <?php include_once "../user/add_comment.php"; ?>
              </div>
              <div class="tabs">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#feed_comment" data-toggle="tab"><b>Комментарии</b></a></li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="feed_comment">
                    <?php include "../user/feed_comment_reply.php";?>
                  </div>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
  <?php include_once "../footer.php";?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.js"></script>
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
?>