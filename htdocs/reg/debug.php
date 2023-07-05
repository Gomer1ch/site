<?php


$user = 'root';
$password = ''; //може бути відсутній root
$db = 'registr';
$host = 'localhost';
$dsn = 'mysql:host='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $password);


$sqlid = 'SELECT MAX(id)+1 as id FROM users';
//$sqlid = 'SELECT 5 as name';
$queryid = $pdo->prepare($sqlid);
//$id = $queryid->execute();
$queryid->execute();
$ids = $queryid->fetchAll(PDO::FETCH_OBJ); //отримали дані як об’єкт
foreach($ids as $id) {      
	echo '<h1>' . $id->id . '</h1>';         
}

//echo '<h1>' . $id . '</h1>';
?>