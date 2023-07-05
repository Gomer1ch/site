<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Авторизація на сайті</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="icon" href="/img/favicon2.ico">
</head>
<body>
  <?php require 'blocks/header.php'; ?>
  <?php
          if(!isset($_COOKIE['cookie'])):
        ?>

        <h4>Форма авторизации</h4>
        <form action="reg/auth2.php" method="post">
          <label for="login">Логин</label>
          <input type="text" name="login" id="login" class="form-control">
          <label for="pass">Пароль</label>
          <input type="password" name="pass" id="pass" class="form-control">
		  <div class="alert alert-danger mt-2 d-none" id="errorBlock"></div>
          <button type="button" id="auth_user" class="btn btn-success mt-5" >
            Авторизація
          </button>
        </form>
		<?php
          else:
        ?>
		<h2><?=$_COOKIE['cookie']?></h2>
        <button class="btn btn-danger" id="exit_btn">Вийти</button>
        <?php
          endif;
        ?>

  <?php require 'blocks/footer.php'; ?> 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script>
  $('#auth_user').click(function () { //якщо натиснули кнопку, то виконується наступний код, що перенаправляє запит на сторону сервера
      var login = $('#login').val(); // отримання даних з форми
      var pass = $('#pass').val();//отримання даних з форми

      $.ajax({ //виконання ajax запиту
        url: 'reg/auth2.php', //той файл, де буде оброблено даний скрипт
        type: 'POST', //тип передачі даних
        cache: false, //вказуємо чи буде кешування даних
        data: {'login' : login, 'pass' : pass}, //яку інформацію передаємо
        dataType: 'html', //спосіб отримання даних
        success: function(data) {//функція, яка буде оброблена після того, як ми отримаємо відповідь від сервера
          if(data == 'Готово') {
            $('#auth_user').text('Все готово'); //зміна назви кнопки
            $('#errorBlock').addClass('d-none');
			document.location.reload(true);
          } else {
            $('#errorBlock').removeClass('d-none'); //показ блоку помилки
            $('#errorBlock').text(data); //помилка, яка передається в параметрі data
          }
        }
      });
    });

  </script>
  
   <script>
    $('#exit_btn').click(function () {
      $.ajax({
        url: 'reg/exit.php',
        type: 'POST',
        cache: false,
        data: {},
        dataType: 'html',
        success: function(data) {
          document.location.reload(true);
        }
      });
    });

   </script>
  
</body>
</html>
