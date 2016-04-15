<?php
/**
 * Created by PhpStorm.
 * User: Shark Riper
 * Date: 15/04/2016
 * Time: 01:07
 */
$login = isset($_POST['login']) ? $_POST['login']: '';
$password = isset($_POST['password']) ? $_POST['password']: '';

if ($login == '') {
    header('location: index.php?error=1');
}elseif ($password = '' ){
    header('location : index.php?error=2&password'.$password);
}else {
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['logged'] = true;

    header('location : profil.php');
}