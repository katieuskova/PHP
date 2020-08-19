<?php

function checkErrors($user){ // Проверка ошибок при регистрации
  
  $errors = [];

  if ($user[1] !== $user[2]){
        $errors[] = "Пароли не совпадают";
  };
  if(preg_match("/[а-яА-Я]/", $user[0])){
        $errors[] = "Логин должен содержать только латинские буквы";
  };
  if(empty($user[0]) || empty($user[1]) || empty($user[2])){
        $errors[] = "Заполните все поля";
  };
  if(strlen($user[1]) < 3) {
        $errors[] = "Небезопасный пароль";
  };

  $list = getCsv('users.csv');

    foreach ($list as $l){
     if(($user[0]) == $l[0]){
      $errors[] = "Логин уже занят";
    }
  };
  return $errors;
};

function save($arr,$file) { //Сохранение в cvs
  $handle = fopen($file, 'a+');
    fputcsv($handle, $arr,';');
  fclose($handle);
};

function getCsv($file){  //Вывод данных из сvs
    $list = [];
    $handler = fopen($file, 'r');
    while (($data = fgetcsv($handler, 0, ';')) !== FALSE) {
        $list[] = $data;
    };
    return $list;
};

function auth($data, $login, $password){ //Авторизация
    foreach ($data as $string) {
        if ($login === $string[0]) {
            if ($password === $string[1]) {
                return true;
            };
        };
    };
};

function rewrite($newUser, $user, $file) { //Перезапись данных cvs

  $list = getCsv($file);
  $handler = fopen($file, 'w');

  foreach ($list as $string){
      if($string[0] == $user){
         unset($string[0]);
         unset($string[1]);
         $string = $newUser;
         array_push($list,$newUser);
      }   
  fputcsv($handler, $string,';');
  };   
};

//Проверка измененных данных
function checkChanges($user, $oldlogin){

  $errors = [];

  if(preg_match("/[а-яА-Я]/", $user[0])){
    $errors[] = "Логин должен содержать только латинские буквы";
  };
  if(empty($user[0]) || empty($user[1])){
    $errors[] = "Заполните все поля";
  };
  if(strlen($user[1]) < 3) {
    $errors[] = "Небезопасный пароль";
  };

  $list = getCsv('../auth/users.csv');

    foreach ($list as $l){
     if(($user[0]) == $l[0] && $l[0] !== $oldlogin){
      $errors[] = "Логин уже занят";
    }
  };
  return $errors;
}
?>
