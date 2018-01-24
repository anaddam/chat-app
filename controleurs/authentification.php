<?php
session_start();
include_once('../models/user.php');
$_SESSION['connected'] = 'not connected';
$user = new User();
if (isset($_SESSION['login'])) {
    $user->setStatus($_SESSION['login'], 0);
}


if (isset($_POST['login']) && isset($_POST['password'])) {
    $login   = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    if ($user->connect($login, $password)) {
        $_SESSION['login']    = $login;
        $_SESSION['connected'] = 'connected';
        header('Location: chat.php');
    } else {
		print "<div class='alert alert-danger' role='alert'>Login ou mot de passe erroné !</div>";
    }
}


include_once('../vues/authentification.php');