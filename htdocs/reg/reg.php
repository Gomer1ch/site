<?php
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

$error = '';

//if(strlen($login) <= 3)
//$error = 'Заповніть імя';
//else if(strlen($email) <= 3)
//$error = 'Заповніть email';
//else if(strlen($name) <= 3)
//$error = 'Заповніть логін';
//else if(strlen($pass) <= 3)
//$error = 'Заповніть пароль';

if(strlen($name) <= 3) //якщо довжина рядка, який ввів користувач менша трьох символів, то відбувається вихід з файлу
$error = 'Заповніть імя';
  else if(strlen($email) <= 3)
$error = 'Заповніть email';
  else if(strlen($login) <= 3)
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

    
$sql = 'INSERT INTO users(name, email, login, pass) VALUES(:name, :email, :login, :pass)';
$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'email' => $email, 'name' => $name, 'pass' => $pass]);	





  echo 'Готово';



//new_url = '/index.php';
//header('Location: '.$new_url);
?>
