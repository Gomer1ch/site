<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP блог</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="icon" href="/img/favicon2.ico">
  <link rel="stylesheet" href="/css/main.css">
</head>
<body>
  <?php require 'blocks/header.php'; ?> 
  <main class="container mt-5"> <!-- Створюємо новий блок, у якого буде основний клас container, з додатковим класом mt-5 (margin top 50px) -->
    <div class="row">
      <div class="col-md-8 mb-2">
<?php 
//в змінні записуємо дані для підключення
  $user = 'root'; 
  $password = '';
  $db = 'registr';
  $host = 'localhost';

  $dsn = 'mysql:host='.$host.';dbname='.$db; //записуємо назву хостнгу та бази даних
  $pdo = new PDO($dsn, $user, $password); //створюємо об’єкт типу pdo

  $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC'; //формуємо sql запит
          $query = $pdo->query($sql); //виконуємо sql запит
          while($row = $query->fetch(PDO::FETCH_OBJ)) { //представляємо вибірку як об’єкт та вибираємо по одному рядку даних 
            echo "<h2>$row->title</h2>
              <p>$row->intro</p>
              <p><b>Автор статті:</b> <mark>$row->author</mark></p>
			  <p><img src='/img/$row->id.jpg' width='300' height='200'></p>
			  <a href='/news.php?id=$row->id' title='$row->title'>
              <button class='btn btn-warning mb-5'>Прочитати більше</button>
			  </a>";		 
 }
	?>
      </div>
    </div>
  </main>
  <?php require 'blocks/footer.php'; ?>
</body>
