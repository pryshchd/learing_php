<?php
require_once 'database_details.php';
$login = $pass = "дефолтное значение";
if (isset($_POST['login'])) $login = $_POST['login'];
if (isset($_POST['pass'])) $pass = $_POST['pass'];

if ($login != "дефолтное значение" and $pass != "дефолтное значение")
  {
    $dbhandle = mysql_connect($hostname, $username, $password)
  or die('не могу подключиться к mySQl: '. mysql_error());
mysql_select_db ($dbname) or die("Не могу выбрать БД $dbname: " . mysql_error());
$preppedlogin = mysql_real_escape_string($login);
$query = "SELECT * FROM Users WHERE login='$login'";
$result = mysql_query($query);
if (!$result) die('не могу подключиться к mySQl: '. mysql_error());
$rows = mysql_num_rows($result);
	if ($rows != 0) echo ("Имя пользователя ". $login ." существует<br />");
		else {
            $hashedpass = crypt($pass, $salt);
			$query = "INSERT INTO Users VALUES('$preppedlogin', '$hashedpass')";
			$result = mysql_query($query);
	die(header("Location: thanks_for_registering.php"));
			}
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