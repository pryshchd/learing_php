<?php
require_once 'database_details.php';

echo 'создаем базу/таблицы<br/>';
$dbhandle = mysql_connect($hostname, $username, $password)
  or die('не могу подключиться к mySQl'. mysql_error());
echo 'подключено к MySQL<br/>';
$dbname = 'first_php_my_db';
if (!mysql_query("CREATE DATABASE $dbname", $dbhandle))
	{ 
		echo ("не могу создать базу: ". mysql_error(). "<br/>");
	} else {
		echo "база создана успешно <br/>";
			}
mysql_select_db ($dbname) or die("Не могу выбрать БД $dbname: " . mysql_error());
echo "база выбрана <br/>";
if (!mysql_query("CREATE TABLE Users(login CHAR(16), password CHAR(16), PRIMARY KEY (login))", $dbhandle)) 
	{
		echo ("не могу создать таблицу Users: ". mysql_error() . "<br/>");
	} else {
		echo "таблица Users создана <br/>";
	}
if (!mysql_query("CREATE TABLE Posts(postno INT(16) NOT NULL AUTO_INCREMENT, login CHAR(16), usrpost CHAR(255), PRIMARY KEY (postno))", $dbhandle)) 
	{
		echo ("не могу создать таблицу Posts: ". mysql_error() . "<br/>");
	} else {
		echo "таблица Posts создана <br/>";
	}	
if (!mysql_close($dbhandle)) die ("не могу закрыть базу:". mysql_error() . "<br/>");
echo "база закрыта <br/>";

?>

