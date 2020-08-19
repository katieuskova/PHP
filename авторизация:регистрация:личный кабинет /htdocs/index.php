<?php

$auth = 0;  // параметр страницы
$pagename = ''; // название страницы, используется для Title и H1

if (isset($_GET['auth'])) {
   $auth = (int)$_GET['auth'];  
};

switch ($auth) {
    case 0:
        $pagename = 'Проект Логин - регистрация';
    break;
    case 1:
        $pagename = 'Проект Логин - авторизация';        
    break;    
    default:
        $pagename = 'Проект Логин - страница не найдена';        
    break;    
}
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pagename; ?></title>
  <link rel="stylesheet" href="src/css/styles.css">
</head>
<body>

<?php // контейнер в который мы загружаем контент с разных страниц 
    switch($auth){

        case 0:
          require 'auth/reg.php'; 
          break;

        case 1:
          require 'auth/auth.php';
          break;
          
        default:
        ?>       
          <p>Еще нет аккаунта?</p>
              <a href="?auth=0"> Регистрация</a>
          <p>Есть аккаунт?</p>
              <a href="?auth=1"> Вход</a>
    <?php break;
        };// контейнер кончается тут?>    
</body>
</html>
