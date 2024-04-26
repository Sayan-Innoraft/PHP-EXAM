<?php

use src\Model\Query;
require '../src/Model/Query.php';

session_start();
// If the user is already logged in then automatically redirects to homepage.
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
  header('Location: /');
}

if(isset($_POST['login'])){
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  if(!isset($email)) {
    $error_msg = 'Please Enter Email';
  }elseif(!isset($password)){
    $error_msg = 'Please Enter Password';
  }else{
    Query::connect();
    if(Query::checkUser($email)){
      if(Query::getUserPassword($email) === $password){
        $_SESSION['logged_in'] = true;
        header('Location: /');
      }else{
        $error_msg = 'Wrong password';
      }
    }else{
      $error_msg = "User doesn't exist";
    }
  }
}
