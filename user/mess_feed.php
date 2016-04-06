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
		$search_mess=mysql_query("SELECT * FROM `mess` WHERE `user_login` = '".$login."' ORDER BY `mess_id` DESC LIMIT ".($page*20).",20");
        //вывод сообщений
        while($mess_feed=mysql_fetch_array($search_mess)) 
		{
            //подсчитываем комментарии каждого сообщения
            $count_comm=mysql_fetch_array(mysql_query("SELECT count(`comment`.comm_id) FROM `comment` WHERE `comment`.mess_id =".$mess_feed['mess_id']));
?>
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
                                                ?>
                                                <a target="_blank" href="/user/comment_reply.php?mess_id=<?php echo $mess_feed['mess_id']; echo "&login=$login"; ?>" class="btn btn-info" data-toggle="tooltip" title data-original-title="Комментарии сообщения">
                                                    <i class="fa fa-comment-o"></i>
                                                    <?php
                                                        echo $count_comm["count(`comment`.comm_id)"]; 
                                                    ?>
                                                </a>
<?php
                                                if ($authorization['user_login'] == $login)
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
<?php
		}
        $q=mysql_query("SELECT * FROM `mess` WHERE `user_login` = '".$login."' ");
		$numpages=ceil(mysql_num_rows($q)/20);
?>
                <nav class="text-center">
                    <ul class="pagination pagination-lg">
                        <li>
<?php
        if($numpages > 1) 
			{
    			if ($page!=0) 
    				{
                        echo "<a href=\"/user/main.php?login="; echo "$login"; echo "&page=0\">";
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
        						echo "<li><a href=\"/user/main.php?login="; echo "$login"; echo "&page=".$i."\">".($i+1)."</a></li> "; 
        					}
        				else 
        				{ 
        					echo "<li><a href=\"/user/main.php?login="; echo "$login"; echo "&page=".$i."\">".($i+1)."</a></li> "; 
        				}
    				}
    			if($page!=($numpages-1)) 
    				{ 
    					echo "<li><a href=\"/user/main.php?login="; echo "$login"; echo "&page=".($numpages-1)."\">";
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
        echo "Возникла ошибка!<br> 
        Не передан логин пользователя чьи сообщения вы желаете просмотреть.";
    } 
?>
                    </ul>
                </nav>