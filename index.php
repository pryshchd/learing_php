<?php
require_once 'database_details.php';
if (isset($_POST['login'])) $login = $_POST['login'];
if (isset($_POST['pass'])) $pass = $_POST['pass'];
$dbhandle = mysql_connect($hostname, $username, $password)
  or die('не могу подключиться к mySQl: '. mysql_error());
mysql_select_db ($dbname) or die("Не могу выбрать БД $dbname: " . mysql_error());

if (isset($_POST['login'])){
$login = $_POST["login"];
$preppedlogin = mysql_real_escape_string($login);
$pass = $_POST["pass"];
$hashedpass = crypt($pass, $salt);
$query = "SELECT login,password FROM Users WHERE login='$preppedlogin' AND password='$hashedpass'";
$result = mysql_query($query);
if (!$result) die('не могу подключиться к mySQl: '. mysql_error());
$rows = mysql_num_rows($result);
if ($rows == 1){
session_start();
$_SESSION['user'] = $login;
die(header("location:personal.php"));
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
    <h1>Димин учебный бложик</h1>
    <form method="post" action="index.php">
    	<p>Войдите если уже зарегистрированы</p>
    	<p>логин <input type="text" name="login" default="login"/></p>
    	<p>пароль <input type="text" name="pass" default="password"/></p>
    	<p><input type="submit" value ="войти" /><a href="register.php">зарегистрироваться</a></p>		
		
</form>
</body>
</html>
_END;
$query = "SELECT * FROM Posts";
$result = mysql_query($query);
if (!$result) die('не могу подключиться к mySQl: '. mysql_error());
while($data=mysql_fetch_array($result))
{
    echo $data['login']." : ".$data['usrpost']."<br />";
}
?>