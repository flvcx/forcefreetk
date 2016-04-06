<?php 
  include_once '../config.php';
  include_once '../authorization.php'; 
  //выводит список сообщений пользователя
  if ($login)
    {
        if(isset($_GET['page'])) 
    { 
      $page=$_GET['page']; 
    } 
    else 
      { 
        $page="0"; 
      }
        //ищем сообщения в БД
    $search_follow_you=mysql_query("SELECT * FROM `follow` WHERE `user_login` = '".$login."' ORDER BY `follow_id` DESC LIMIT ".($page*10).",10");
        //вывод сообщений
        while($follow_feed=mysql_fetch_array($search_follow_you)) 
        {
?>
            <div class="alert alert-block alert-info">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <a class="btn btn-info btn-block" href="/user/main.php?login=<?php echo $follow_feed['follow_login']; ?>">
                               <b><?php echo $follow_feed['follow_login']; ?></b>
                            </a>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                            <p><strong>Читаете с: </strong> <?php echo $follow_feed['follow_data']; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <br> 

<?php
        }
        $q=mysql_query("SELECT * FROM `follow` WHERE `user_login` = '".$login."' ");
        $numpages=ceil(mysql_num_rows($q)/10);
?>
                <nav class="text-center">
                    <ul class="pagination pagination-lg">
                        <li>
<?php
        if($numpages > 1) 
      {
          if ($page!=0) 
            {
                        echo "<a href=\"/user/follow_you.php?login="; echo "$login"; echo "&page=0\">";
                        echo '
                            <i class="fa fa-chevron-left"></i>
                            <i class="fa fa-chevron-left"></i>
                            </a>
                        </li>'; 
            }
          for ($i=0;$i<$numpages;$i++) 
            {
                if($page != $i) 
                  { 
                    echo "<li><a href=\"/user/follow_you?login="; echo "$login"; echo "&page=".$i."\">".($i+1)."</a></li> "; 
                  }
                else 
                { 
                  echo "<li><a href=\"/user/follow_you?login="; echo "$login"; echo "&page=".$i."\">".($i+1)."</a></li> "; 
                }
            }
          if($page!=($numpages-1)) 
            { 
              echo "<li><a href=\"/user/follow_you?login="; echo "$login"; echo "&page=".($numpages-1)."\">";
                        echo '
                            <i class="fa fa-chevron-right"></i>
                            <i class="fa fa-chevron-right"></i>
                            </a>
                            </li>'; 
            }
      }
    }
    else
    {
        echo "Возникла ошибка!<br>";
    } 
?>
                    </ul>
                </nav>