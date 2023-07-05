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
  <?php require 'blocks/header.php'; ?>
  <main class="container mt-5"> <!-- Створюємо новий блок, у якого буде основний клас container, з додатковим класом mt-5 (margin top 50px) -->
    <div class="row">
      <div class="col-md-8 mb-3">
        Основна частина сайту
      </div>
		<?php require 'blocks/carousel.php'; ?>
    </div>
  </main>
  <?php require 'blocks/footer.php'; ?>
</body>
</html>
