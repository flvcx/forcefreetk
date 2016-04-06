<?php 
	$count_like=mysql_fetch_array(mysql_query("SELECT count(`like`.like_id) FROM `like` WHERE `like`.mess_id =".$mess_feed['mess_id']));
	if ($authorization)
		{	
			//если пользователь есть в таблице
?>
			<html>
				<a class="btn btn-info" href="/user/like.php?mess_id=<?php echo $mess_feed['mess_id']; ?>">
					<span class="fa fa-heart"></span>
					 <?php echo $count_like["count(`like`.like_id)"]; ?>
				</a>
			</html>
<?php
		} 
		else
		{
?>
			<html>
				<a class="btn btn-info">
					<span class="fa fa-heart"></span>
					 <?php echo $count_like["count(`like`.like_id)"]; ?>
				</a>
			</html>
<?php
		}
?>