<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Авторизация на сайте:</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<style>
body {
 background-image: url(img/OZ5NRVL6QK.jpg);
}	
</style>
<body>
<div align="center"><h2>Введите данные для входа в учетную запись</h2>
 <section class="login-form-wrap">
<form class="login-form" action="index.php" method="post">
    <label>
      <input type="email" name="login" required placeholder="Ваше имя">
    </label>
    <label>
      <input type="password" name="password" required placeholder="Ваш пароль">
    </label>
    <input type="submit" name="submit">
  </form>
</section>
</div>
<div id="lastmain">
			<a href="index.html" class="main-action">Вернуться &nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i> &mdash; в блог</a>
		</div>

<?php $connection = mysqli_connect('localhost', 'root', '', 'reg') or die(mysqli_error()); // Соединение с базой данных ?>

<?php if (isset($_POST['submit'])) // Отлавливаем нажатие кнопки "Отправить"
{
if (empty($_POST['login'])) // Если поле логин пустое
{
echo '<script>alert("Поле логин не заполненно");</script>'; // То выводим сообщение об ошибке
}
elseif (empty($_POST['password'])) // Если поле пароль пустое
{
echo '<script>alert("Поле пароль не заполненно");</script>'; // То выводим сообщение об ошибке
}
else  // Иначе если все поля заполненны
{    
$login = $_POST['login']; // Записываем логин в переменную 
$password = $_POST['password']; // Записываем пароль в переменную           
$query = mysqli_query($connection, "SELECT `id` FROM `users` WHERE `login` = '$login' AND `password` = '$password'"); // Формируем переменную с запросом к базе данных с проверкой пользователя
$result = mysqli_fetch_array($query); // Формируем переменную с исполнением запроса к БД 
if (empty($result['id'])) // Если запрос к бд не возвразяет id пользователя
{
echo '<script>alert("Неверные Логин или Пароль");</script>'; // Значит такой пользователь не существует или не верен пароль
}
else // Если возвращяем id пользователя, выполняем вход под ним
{
$_SESSION['password'] = $password; // Заносим в сессию  пароль
$_SESSION['login'] = $login; // Заносим в сессию  логин
$_SESSION['id'] = $result['id']; // Заносим в сессию  id
echo '<div align="center">Вы успешно вошли в систему: '.$_SESSION['login'].'</div>'; // Выводим сообщение что пользователь авторизирован        
}     
}		
} ?>

<?php if (isset($_GET['exit'])) { // если вызвали переменную "exit"
unset($_SESSION['password']); // Чистим сессию пароля
unset($_SESSION['login']); // Чистим сессию логина
unset($_SESSION['id']); // Чистим сессию id
} ?>

<?php if (isset($_SESSION['login']) && isset($_SESSION['id'])) // если в сессии загружены логин и id
{
echo '<div id="lastmain"><a href="index.php?exit" class="main-action">Выход &nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i>
</a></div>'; // Выводим нашу ссылку выхода
} ?>

<?php if (!isset($_SESSION['login']) || !isset($_SESSION['id'])) // если в сессии не загружены логин и id
{
//echo '<div id="lastmain">
//			<a href="reg.php" class="main-action">Создать &nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i> &mdash; учетную запись</a>
//		</div>'; // Выводим нашу ссылку регистрации
} ?>

</body>
</html>
