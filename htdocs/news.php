<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Статті</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="icon" href="/img/favicon.ico">
  <link rel="stylesheet" href="/css/main.css">

</head>
	<body>
	   <?php require 'blocks/header.php'; ?>
	  <?php
	  $user = 'root';
	  $password = '';
	  $db = 'registr';
	  $host = 'localhost';

	  $dsn = 'mysql:host='.$host.';dbname='.$db;
	  $pdo = new PDO($dsn, $user, $password);
	  
	  $sql = 'SELECT * FROM `articles` WHERE `id` = :id'; //обираємо статті за заданим id
      $query = $pdo->prepare($sql); //готуємо sql запит
      $query->execute(['id' => $_GET['id']]); //виконуємо sql запит (беремо значення з масиву GET та передаємо в запит по ключу id
      $article = $query->fetch(PDO::FETCH_OBJ); //формуємо вибірку як об’єкт 
    ?>
<main class="container mt-5"> <!-- Створюємо новий блок, у якого буде основний клас container, з додатковим класом mt-5 (margin top 50px) -->
    <div class="row">
      <div class="col-md-8 mb-2">
        <div class="jumbotron">
          <h1><?=$article->title?></h1>
          <p><b>Автор статті:</b> <mark><?=$article->author?></mark></p>
          <?php
            $date = date('d ', $article->date); //записуємо лише день у вигляді числа
            $array = ["Січня", "Лютого", "Березня", "Квітня", "Травня", "Червня", "Липня", "Серпня", "Вересня", "Жовтня", "Листопада", "Грудня"];//поміщаємо назви місяців
            $date .= $array[date('n', $article->date) - 1]; //додаємо значення в кінець змінної date, а саме місяць назвою. Так як відлік в масиві йде з нуля, то віднімаємо 1
            $date .= date(' H:i', $article->date); //додаємо години та хвилини
          ?>
          <p><b>Час публікації:</b> <u><?=$date?></u></p> 
			<?php 
				 echo "
				<p><img src='/img/$article->id.jpg' width='300' height='200'></p>
				";
			?>
          <p>
            <?=$article->intro?>
            <br><br>
            <?=$article->text?>
          </p>
        </div>

      </div>
    </div>
	<h3 class="mt-5">Комментарі</h3>
        <form action="/news.php?id=<?=$_GET['id']?>" method="post">

          <label for="username">Ім'я</label> 
          <input type="text" name="username" id="username" class="form-control">

          <label for="mess">Повідомлення</label>
          <textarea name="mess" id="mess" class="form-control"></textarea>

          <button type="submit" id="mess_send" class="btn btn-success mt-3 mb-5">
            Додати коментар
          </button>
        </form>
		<?php
		  if (isset($_POST['username'])&&isset ($_POST['mess'])){ //Визначає, чи була встановлена змінна значенням відмінним від NULL
          if($_POST['username'] != '' && $_POST['mess'] != '') { //якщо поля імені користувача та повідомлення не пусті
            $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING)); //відбувається фільтрація даних
            $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));//відбувається фільтрація даних
			
			$sql = 'INSERT INTO comments(name, mess, article_id) VALUES(:name, :mess, :article_id)';
            $query = $pdo->prepare($sql);
            $query->execute(['name' => $username,'mess' => $mess,'article_id' => $_GET['id']]);
			}
		  }
		  $sql = 'SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC'; //формування sql запиту виводу статей по id та сортуванню по зменшенню
          $query = $pdo->prepare($sql); //підготовка sql запиту
          $query->execute(['id' => $_GET['id']]); //виконання sql запиту
          $comments = $query->fetchAll(PDO::FETCH_OBJ); //представлення усіх рядків як об'єктів та вибірка всіх об'єктів

          foreach ($comments as $comment) { //будемо перебирати всі дані об'єктів по черзі та виводити на екран
            echo "<div class='alert alert-info mb-2'> 
              <h4>$comment->name</h4>
              <p>$comment->mess</p>
            </div>";
          }
		?>




  </main>

  <?php require 'blocks/footer.php'; ?>
</body>
</html>

