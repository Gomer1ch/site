<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TEST</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="icon" href="/img/favicon2.ico">
</head>
<body>
	<?php
	  if(!isset($_COOKIE['cookie']) || empty($_COOKIE['cookie'])) {
		header('Location: /regestration.php');
		exit();
	  }
	?>

  <?php require 'blocks/header.php'; ?>
          <h4>Додавання статті</h4>
        <form action="" method="post">
          <label for="title">Заголовок статті</label>
          <input type="text" name="title" id="title" class="form-control">
          <label for="intro">Інтро статті</label>
          <textarea name="intro" id="intro" class="form-control"></textarea>
          <label for="text">Текст статті</label>
          <textarea name="text" id="text" class="form-control"></textarea>
          <div class="alert alert-danger mt-2 d-none" id="errorBlock"></div>
          <button type="button" id="article_send" class="btn btn-success mt-3">
            Додати
          </button>
        </form>


  <?php require 'blocks/footer.php'; ?> 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script>
	$('#article_send').click(function () {
      var title = $('#title').val();
      var intro = $('#intro').val();
      var text = $('#text').val();

      $.ajax({
        url: 'reg/add_article.php',
        type: 'POST',
        cache: false,
        data: {'title' : title, 'intro' : intro, 'text' : text},
        dataType: 'html',
        success: function(data) {
          if(data == 'Готово') {
            $('#article_send').text('Все готово');
            $('#errorBlock').addClass('d-none');
          } else {
            $('#errorBlock').removeClass('d-none');
            $('#errorBlock').text(data);
          }
        }
      });
    });

  </script>
  


  
</body>
</html>
