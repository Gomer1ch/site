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
	  if(isset($_COOKIE['cookie']) || !empty($_COOKIE['cookie'])) {
		header('Location: /auth.php');
		exit();
	  }
	  ?>
  <?php require 'blocks/header.php'; ?>
        <h4>Форма регистрации</h4>
        <form action="reg/reg.php" method="post">
          <label for="username">Ваше имя</label>
          <input type="text" name="username" id="username" class="form-control">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
          <label for="login">Логин</label>
          <input type="text" name="login" id="login" class="form-control">
          <label for="pass">Пароль</label>
          <input type="password" name="pass" id="pass" class="form-control">
		  <div class="alert alert-danger mt-2 d-none" id="errorBlock"></div>
          <button type="button" id="reg_user" class="btn btn-success mt-5" >
            Зарегистрироваться
          </button>
        </form>

  <?php require 'blocks/footer.php'; ?> 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script>
  $('#reg_user').click(function () { //якщо натиснули кнопку, то виконується наступний код, що перенаправляє запит на сторону сервера
      var name = $('#username').val();//отримання даних з форми
      var email = $('#email').val(); // отримання даних з форми
      var login = $('#login').val(); // отримання даних з форми
      var pass = $('#pass').val();//отримання даних з форми

      $.ajax({ //виконання ajax запиту
        url: 'reg/reg.php', //той файл, де буде оброблено даний скрипт
        type: 'POST', //тип передачі даних
        cache: false, //вказуємо чи буде кешування даних
        data: {'login' : login, 'email' : email, 'name' : name, 'pass' : pass}, //яку інформацію передаємо
        dataType: 'html', //спосіб отримання даних
        success: function(data) {//функція, яка буде оброблена після того, як ми отримаємо відповідь від сервера
          if(data == 'Готово') {
            $('#reg_user').text('Все готово'); //зміна назви кнопки
            $('#errorBlock').addClass('d-none');
          } else {
            $('#errorBlock').removeClass('d-none'); //показ блоку помилки
            $('#errorBlock').text(data); //помилка, яка передається в параметрі data
          }
        }
      });
    });

  </script>
  


  
</body>
</html>
