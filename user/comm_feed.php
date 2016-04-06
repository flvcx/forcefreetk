<?php 
    include_once '../config.php';
    include_once '../authorization.php';
    //выводит список сообщений пользователя
    if (isset($_GET['login']))
    {
        $login = $_GET['login'];
        if(isset($_GET['page'])) 
        { 
            $page=$_GET['page']; 
        } 
        else 
        { 
            $page="0"; 
        }
        //ищем сообщения в БД
        $search_comm=mysql_query("SELECT * FROM `comment` WHERE `user_login` = '".$login."' ORDER BY `comm_id` DESC LIMIT ".($page*20).",20");
        //вывод сообщений
        while($comm_feed=mysql_fetch_array($search_comm))  
        {
            //подсчитываем комментарии каждого сообщения
?>
        <br>

            <section class="comment-list">
                            <!-- First Comment -->
                                <article class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <a href="/user/main.php?login=<?php echo $comm_feed['user_login']; ?>"><?php
                                                include '../user/profile_picture/feed_profile_picture.php';
                                            ?>
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="panel-heading right">Ответ
                                                    </div>
                                                    <div class="comment-user">
                                                        <i class="fa fa-user"></i>
                                                            <a href="/user/main.php?login=<?php echo $comm_feed['user_login']; ?>">
                                                                <?php echo $comm_feed['user_login']; ?>
                                                            </a>
                                                    </div>
                                                        <time class="comment-date"><i class="fa fa-clock-o"></i><?php echo $comm_feed['comm_data']; ?></time>
                                                </header>
                                                <div class="comment-post">
                                                    <hr>
                                                    <p>
                                                        <?php 
                                                            echo $comm_feed['comm_messeg']; 
                                                        ?>
                                                    <hr>
                                                    </p>
                                                </div>
                                                <p class="text-right">
                                                    
                                                    <a href="#spoiler-comment-<?php echo $comm_feed['mess_id']; ?>" data-toggle="collapse" class="btn btn-default spoiler collapsed">Ответ к ...</a>
                                                    <?php
                                                        if ($authorization['user_login'] == $login)
                                                        {
                                                        ?>
                                                        <a href="/user/delete_comm.php?comm_id=<?php echo $comm_feed['comm_id']; ?>" class="btn btn-danger" data-toggle="tooltip" title data-original-title="Удалить ответ">
                                                        <i class="fa fa-times"></i></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    <div class="collapse" id="spoiler-comment-<?php echo $comm_feed['mess_id']; ?>">
                                                        <div class="well">
                                                            <?php
                                                                $search_mess=mysql_query("SELECT * FROM `mess` WHERE `mess_id` = '".$comm_feed['mess_id']."' ");
                                                                $mess_feed=mysql_fetch_array($search_mess);
                                                            ?>
                                                            <p>
                                                                <?php
                                                                    if ($mess_feed)
                                                                    {
                                                                        echo $mess_feed['mess_messeg'];
                                                                    ?>
                                                                        <br>
                                                                        <hr>
                                                                        <a class="btn btn-info" href="/user/comment_reply.php?mess_id=<?php echo $comm_feed['mess_id']; echo "&login="; echo $mess_feed['user_login'];?>">Перейти к сообщению</a>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "Сообщение к которому отправлен ответ удалено.";
                                                                    }
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
            </section>
<?php
        }
        $q_comm=mysql_query("SELECT * FROM `comment` WHERE `user_login` = '".$login."' ");
        $numpages=ceil(mysql_num_rows($q_comm)/20);
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