<?php
session_start();
include_once('../models/chat.php');
include_once('../models/user.php');

if ($_SESSION['connected'] == 'connected' && isset($_SESSION['login'])) {
    $chat = new Chat();
    $user = new User();
    if (isset($_POST['message'])) {
        $login  = $_SESSION['login'];
        $message = htmlspecialchars($_POST['message']);

        $chat->addMessage($login, $message);
    }

    $messages = $chat->getAllMessages();
    $users = $user->getAllUsers();

    include_once('../vues/chat.php');
} else {
    header('Location: authentification.php');
}
