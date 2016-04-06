<h1>###forcefree###</h1>
 <b>Service micro blogs. Is under alpha testing.</b>
 demo: <b>http://forcefree.tk</b><br> 
 <b>Support:</b> forcefree1@gmail.com
<hr>

# <b>1 The next changes:</b><br>
 1.1 A global style change application<br>
 1.2 Division of users into categories (User, moderator, Administrator)<br>
 1.3 Distribution of functional parts for users<br>
 1.4 The introduction of AJAX<br>
 1.5 Changes in the structure of the application<br>
 1.6 Change application logic<br>
 1.7 Edit existing application code.<br>

<b><h1>###Run the application###</h1></b><br>
# <b>2 The requirement for the server part:</b><br>
2.1 PHP >= 5.6<br>
2.2 MySQL >= 5.5<br>
2.3 Apache >=2.4<br>


# <b>3 SQL queries to create the database:</b><br>
# 3.1 create the database<br>
CREATE DATABASE `db` /*!40100 COLLATE 'utf8_general_ci' */<br>
# 3.2 create table "user"<br>
CREATE TABLE `user` (<br>
	`user_id` INT(11) NOT NULL AUTO_INCREMENT,<br>
	`user_login` CHAR(16) NOT NULL,<br>
	`user_pass` CHAR(32) NOT NULL,<br>
	`user_email` CHAR(225) NOT NULL,<br>
	`user_name` CHAR(50) NOT NULL,<br>
	`user_sex` CHAR(16) NOT NULL,<br>
	`user_birthday_data` DATE NULL DEFAULT NULL,<br>
	`user_country` CHAR(32) NULL DEFAULT NULL,<br>
	`user_city` CHAR(32) NULL DEFAULT NULL,<br>
	`user_data_reg` DATE NULL DEFAULT NULL,<br>
	`user_about` CHAR(120) NULL DEFAULT NULL,<br>
	`profile_picture` CHAR(250) NULL DEFAULT NULL,<br>
	PRIMARY KEY (`user_id`),<br>
	INDEX `user_login` (`user_login`)<br>
)<br>
COLLATE='utf8_general_ci'<br>
ENGINE=InnoDB<br>
AUTO_INCREMENT=10<br>
;<br>

# 3.3 create table "mess"<br>
CREATE TABLE `mess` (<br>
	`mess_data` DATETIME NOT NULL,<br>
	`user_login` CHAR(16) NOT NULL,<br>
	`mess_messeg` CHAR(255) NOT NULL,<br>
	`mess_url_img1` CHAR(50) NULL DEFAULT NULL,<br>
	`mess_url_img2` CHAR(50) NULL DEFAULT NULL,<br>
	`mess_url_img3` CHAR(50) NULL DEFAULT NULL,<br>
	`mess_id` INT(11) NOT NULL AUTO_INCREMENT,<br>
	PRIMARY KEY (`mess_id`)<br>
)<br>
COLLATE='utf8_general_ci'<br>
ENGINE=InnoDB<br>
AUTO_INCREMENT=48<br>
;<br>
<br>
# 3.4 create table "comment"<br>
CREATE TABLE `comment` (<br>
	`comm_data` DATETIME NOT NULL,<br>
	`comm_id` INT(11) NOT NULL AUTO_INCREMENT,<br>
	`mess_id` INT(11) NOT NULL,<br>
	`user_login` CHAR(16) NOT NULL,<br>
	`comm_messeg` CHAR(255) NOT NULL,<br>
	`com_url_img1` CHAR(50) NULL DEFAULT NULL,<br>
	`com_url_img2` CHAR(50) NULL DEFAULT NULL,<br>
	`com_url_img3` CHAR(50) NULL DEFAULT NULL,<br>
	PRIMARY KEY (`comm_id`)<br>
)<br>
COLLATE='utf8_general_ci'<br>
ENGINE=InnoDB<br>
AUTO_INCREMENT=6<br>
;<br>
<br>
# 3.5 create table "like"<br>
CREATE TABLE `like` (<br>
	`like_id` INT(11) NOT NULL AUTO_INCREMENT,<br>
	`mess_id` INT(11) NOT NULL,<br>
	`like_login` CHAR(16) NOT NULL,<br>
	PRIMARY KEY (`like_id`)<br>
)<br>
COLLATE='utf8_general_ci'<br>
ENGINE=InnoDB<br>
AUTO_INCREMENT=6<br>
;<br>
<br>
# 3.6 create table "follow"<br>
CREATE TABLE `follow` (<br>
	`follow_id` INT(11) NOT NULL AUTO_INCREMENT,<br>
	`user_login` CHAR(16) NOT NULL,<br>
	`follow_login` CHAR(16) NOT NULL,<br>
	`follow_data` DATE NOT NULL,<br>
	PRIMARY KEY (`follow_id`)<br>
)<br>
COLLATE='utf8_general_ci'<br>
ENGINE=InnoDB<br>
AUTO_INCREMENT=22<br>
;<br>
<br>
# 3.7 create table "error"<br>
CREATE TABLE `error` (<br>
	`error_id` INT(11) NOT NULL AUTO_INCREMENT,<br>
	`error_email` VARCHAR(255) NOT NULL DEFAULT '0',<br>
	`error_url` VARCHAR(60) NOT NULL DEFAULT '0',<br>
	`error_about` VARCHAR(500) NOT NULL DEFAULT '0',<br>
	PRIMARY KEY (`error_id`)<br>
)<br>
COLLATE='utf8_general_ci'<br>
ENGINE=InnoDB<br>
;<br>
<br>
# <b>4 The connection to the database</b><br>
The connection to the database is in the file config.php<br>
