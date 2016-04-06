<?php
    include_once '../../config.php';
    include_once '../../authorization.php';

    if(isset($_GET['login'])==$authorization['user_login']) 
    {
        if (!empty($_POST['email']) ||
            !empty($_POST['name']) ||
            !empty($_POST['sex']) ||
            !empty($_POST['birthday_data']) ||
            !empty($_POST['country']) ||
            !empty($_POST['city']) ||
            !empty($_POST['about'])
            )
        {
            $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
            $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
            $sex = mysql_real_escape_string(htmlspecialchars($_POST['sex']));
            $birthday_data = mysql_real_escape_string(htmlspecialchars($_POST['birthday_data']));
            $country = mysql_real_escape_string(htmlspecialchars($_POST['country']));
            $city = mysql_real_escape_string(htmlspecialchars($_POST['city']));
            $about = mysql_real_escape_string(htmlspecialchars($_POST['about']));
            $update_ank = mysql_query("UPDATE user SET `user_email` = '".$email."', `user_name` = '".$name."', `user_sex` = '".$sex."', `user_birthday_data` = '".$birthday_data."', `user_country` = '".$country."', `user_city` = '".$city."', `user_about` = '".$about."' WHERE `user_login` = '".$authorization['user_login']."' ");
            if ($update_ank)
            {
                echo '
                <script type="text/javascript">
                window.location.href="/user/setting.php?login='.$authorization['user_login'].' "
                </script>
                ';
            }
        }
        else
        {
            echo '
                <script type="text/javascript">
                window.location.href="/"
                </script>
                '; 
        }
    ?>
            
<?php
    }
    else
    {
        echo '
                <script type="text/javascript">
                window.location.href="/"
                </script>
                ';
    }
?>