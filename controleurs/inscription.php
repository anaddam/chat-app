<?php
session_start();
include_once('../models/user.php');

$_SESSION['connected'] = 'not connected';
if (isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] == $_POST['password2']) {
    if (isset($_POST['login'])) {
        $login   = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $user     = new User();
        if ($user->create($login, $password)) {
            $_SESSION['login']    = $login;
            $_SESSION['connected'] = 'connected';
            header('Location: chat.php');
        } else {
			print "<div class='alert alert-danger' role='alert'>Login deja existant !</div>";
        }
    }
} else {
	print "<div class='alert alert-danger' role='alert'>Mot de passe différents !</div>";
}


include_once('../vues/authentification.php');