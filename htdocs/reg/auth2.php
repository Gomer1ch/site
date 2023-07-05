<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
$error = '';
if(strlen($login) <= 3)
  $error = 'Заповніть логін';
else if(strlen($pass) <= 3)
  $error = 'Заповніть пароль';
if($error != '') {
  echo $error;
  exit();
}

$hash = "sdfjsdkhgs234jh324SDk";
$pass = md5($pass . $hash);
$user = 'root';
$password = ''; //може бути відсутній root
$db = 'registr';
$host = 'localhost';
$dsn = 'mysql:host='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $password);

$sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `pass` = :pass';
$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'pass' => $pass]);
$user = $query->fetch(PDO::FETCH_OBJ);

if ($query->rowCount() == 0){
  echo 'Такого користувача не існує';
}
else {
  setcookie('cookie', $login, time() + 3600 * 24 * 30, "/");
  echo 'Готово';
}
?>
