<?php 
session_start();

//Уничтожение сессии при отсутствии активности более 30 мин
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  session_unset();      
  session_destroy();   
}
$_SESSION['LAST_ACTIVITY'] = time();

//Проверка на попытку входа без авторизации
if (!isset($_SESSION['login'])){
      header("Location: ../index.php");
      exit();
}
else {
    echo '<h2> Добро пожаловать, ' .$_SESSION["login"].'! </h2>';
};
 
//Вывод сообщения об изменении данных
if(isset($_SESSION['message'])){
  echo $_SESSION['message'];
  unset($_SESSION['message']);
}

//Выход из лк
if(isset($_GET['exit'])){
    header("Location: ../index.php");
    session_destroy();
    exit();
};

?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Личный кабинет</title>
  <link rel="stylesheet" href="../src/css/styles.css">
</head>
<body>
  <p><a href="?exit">Выход</a><p>
  <p>Изменить данные:</p>
  <form action="edit.php" method="post">
    <input name="login" type="text" placeholder="Новый логин">
    <input name="password" type="text" placeholder="Новый пароль">
    <button type= "submit">Изменить</button>
  </form>
</body>
</html>



   