<?php
require_once 'database_details.php';
$usrpost = "дефолтное значение";
session_start();
if (isset($_SESSION['user'])) $user = $_SESSION['user'];
if (isset($_POST['usrpost'])) $usrpost = $_POST['usrpost'];
$dbhandle = mysql_connect($hostname, $username, $password)
  or die('не могу подключиться к mySQl: '. mysql_error());
mysql_select_db ($dbname) or die("Не могу выбрать БД $dbname: " . mysql_error());

if ($usrpost != "дефолтное значение")
{
$query = "INSERT INTO Posts VALUES (NULL,'$user','$usrpost')";
$result = mysql_query($query);
if (!$result) die('не могу подключиться к mySQl при добавлении поста: '. mysql_error());
}
echo <<<_END
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>бложик</title>
</head>
<body>
    <h1>Запости чего-нибудь на главной странице, $user</h1>
    <form method="post" action="personal.php">
    	<p>пост: <input type="text" name="usrpost" /></p>
    	<p><input type="submit" value ="запостить" />	
		
</form>
</body>
</html>
_END;
echo "Добавлено: " . $usrpost;
?>