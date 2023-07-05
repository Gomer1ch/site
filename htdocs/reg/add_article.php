<?php    
  $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
  $intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
  $text = trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($title) <= 3)
    $error = 'Введіть назву статты';
  else if(strlen($intro) <= 15)
    $error = 'Введіть інтро для статті';
  else if(strlen($text) <= 20)
    $error = 'Введіть текст статті';

  if($error != '') {
    echo $error;
    exit();
  }

 //$hash = "sdfjsdkhgs234jh324SDk";
  //$pass = md5($pass . $hash);

  $user = 'root';
  $password = '';
  $db = 'registr';
  $host = 'localhost';

  $dsn = 'mysql:host='.$host.';dbname='.$db;
  $pdo = new PDO($dsn, $user, $password);

	$sql = 'INSERT INTO articles (title, intro, text, date, author) VALUES (:title, :intro, :text, :date, :author)';
	$query = $pdo->prepare($sql);
	$query->execute([
	  'title' => $title,
	  'intro' => $intro,
	  'text' => $text,
	  'date' => time(),
	  'author' => $_COOKIE['cookie']
	]);


  echo 'Готово';

?>
