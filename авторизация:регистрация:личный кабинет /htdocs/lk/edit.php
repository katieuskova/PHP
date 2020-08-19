<?php

session_start();

require_once '../src/functions.php';

$user = array($_POST['login'], $_POST['password']);

$errors = checkChanges($user,$_SESSION["login"]);

if(empty($errors)){
    rewrite($_POST, $_SESSION["login"], '../auth/users.csv');
    $_SESSION['message'] = 'Данные успешно изменены!';
}
else { 
    $_SESSION['message'] = implode(', ', $errors);
}

header("Location: index.php");
?>
