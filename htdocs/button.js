const button = document.getElementById('reg_user');
$('#reg_user').click(function () { //якщо натиснули кнопку, то виконується наступний код, що перенаправляє запит на сторону сервера
      var name = $('#login').val(); //отримання даних з форми
      var email = $('#email').val(); // отримання даних з форми
      var login = $('#name').val(); // отримання даних з форми
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
            $('#errorBlock').hide();
          } else {
            $('#errorBlock').show(); //показ блоку помилки
            $('#errorBlock').text(data); //помилка, яка передається в параметрі data
          }
        }
      });
    });
