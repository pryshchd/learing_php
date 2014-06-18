<?php
require_once 'database_details.php';
if (isset($_POST['login'])) $login = $_POST['login'];
else $login = "NULL";
if (isset($_POST['pass'])) $pass = $_POST['pass'];
else $pass = "NULL";

$dbhandle = mysql_connect($hostname, $username, $password)
  or die('не могу подключиться к mySQl'. mysql_error());
 $dbname = 'first_php_my_db';
mysql_select_db ($dbname) or die("Не могу выбрать БД $dbname: " . mysql_error());

$query = "SELECT * FROM members WHERE login='$login'";
$result = mysql_query($query);
if ((mysql_num_rows($result)) != 0) echo "Имя пользователя существует<br />";
else {
	$query = "INSERT INTO members VALUES('$login', '$pass')";
	$result = mysql_query($query);
	die("<h4>пользователь зарегистрирован</h4><br />");
}

echo <<<_END
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>бложик</title>
</head>
<body>
    <h1>Регистрация</h1>
    <form method="post" action="register.php">
    	<p>введите логин и пароль для регистрации нового пользователя</p>
    	<p>логин <input type="text" name="login"/></p>
    	<p>пароль <input type="text" name="pass"/></p>
    	<p><input type="submit" value ="зарегистрироваться"/></p>		
		
</form>
</body>
</html>
_END;
?>