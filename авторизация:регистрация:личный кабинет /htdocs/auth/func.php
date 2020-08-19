<?php
session_start();
require '../src/functions.php';

//Регистрация
if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password_conf'])){

$login = strip_tags($_POST['login']);
$pass = strip_tags($_POST['password']);
$pass_conf = strip_tags($_POST['password_conf']);
$user = array($login, $pass, $pass_conf);  
$errors = checkErrors($user);

if(empty($errors)){
    save($user,'users.csv');
    $msg_box = '<p>Вы успешно зарегистрированы!</p>';
}
else {
    foreach ($errors as $error) {
        $msg_box = '<p>' .$error. '</p>';
      };
   };
   
echo json_encode(array('result' => $msg_box));
}

//Авторизация
elseif (isset($_POST['login']) && isset($_POST['password'])){
    $login = strip_tags($_POST['login']);
    $pass = strip_tags($_POST['password']);

    $list = getCsv('users.csv');

    if(auth($list, $login, $pass)){
        $msg_box = '';
        $_SESSION["login"]=$login;  
    }
    else {
        $msg_box = 'Проверьте корректность введенных данных или зарегистрируйтесь!';
    };

echo json_encode(array('result' => $msg_box));
}
?>


