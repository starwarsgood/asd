<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Регистрация на сайте</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<style>
body {
 background-image: url(img/OZ5NRVL6QK.jpg);
}	
</style>

<div align="center"><h2>Регистрация на сайте:</h2>
 <section class="login-form-wrap">
<form class="login-form" action="reg.php" method="post">
    <label>
      <input type="email" name="login2" required placeholder="Ваше имя">
    </label>
    <label>
      <input type="password" name="password2" required placeholder="Ваш пароль">
    </label>
    <input type="submit" name="submit2">
  </form>
</section>
</div>



<?php $connection = mysqli_connect('localhost', 'root', '', 'reg') or die(mysqli_error()); // Соединение с базой данных ?> 

<?php if (isset($_POST['submit2'])) // Отлавливаем нажатие на кнопку отправить 
{
if (empty($_POST['login2']))  // Условие - если поле логин пустое
{
echo "<script>alert('Поле логин не заполненно');</script>"; // Выводим сообщение об ошибке
}          
elseif (empty($_POST['password2'])) // Иначе если поле с паролем пустое
{
echo "<script>alert('Поле логин не заполненно');</script>"; // Выводим сообщение об ошибке
}                      
else // Иначе если поля не пустые
{
$login2 = $_POST['login2']; // Присваеваем переменной значение из поля с логином             
$password2 = $_POST['password2']; // Присваеваем другой переменной значение из поля с паролем
$query = "INSERT INTO `users` (login, password) VALUES ('$login2', '$password2')"; // Создаем переменную с запросом к базе данных на отправку нового юзера
$result = mysqli_query($connection, $query) or die(mysql_error()); // Отправляем переменную с запросом в базу данных 
echo "<div align='center'>Регистрация прошла успешно!</div>"; // Сообщаем что все получилось
}
}
echo '<div id="lastmain">
			<a href="index.php" class="main-action">Войти &nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i> &mdash; в  учетную запись</a>
		</div>';
 ?>

</body>
</html>