<?php
include_once('../db_config/config.php');

class Chat
{
    private $bdd;

    function __construct()
    {
        try {
             $this->bdd = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASSWORD, [
                                                                      PDO::ATTR_ERRMODE =>
                                                                          PDO::ERRMODE_EXCEPTION,
                                                                  ]
            );
            $this->bdd->exec('SET CHARACTER SET utf8');
        } catch (Exception $e) {
            die('ERREUR : Impossible de se connecter à la base de donnée.' . $e->getMessage());
        }
    }

    function getAllMessages()
    {
        $messages = [];
        $query    = $this->bdd->query('SELECT login, message, DATE_FORMAT(date_post, "%d/%m/%Y %H:%i:%s") AS date_post 
        FROM 
        chat ORDER BY id ASC LIMIT 30'
        );
        $i        = 0;
        while ($data = $query->fetch()) {
            $messages[$i] = $data;
            $i++;
        }
        return $messages;
    }

    function addMessage($login, $message)
    {
        $query = $this->bdd->prepare('INSERT INTO chat(login, message, date_post) VALUES(:login, :message, NOW())');
        $query->execute([
                            'login'  => htmlspecialchars($login),
                            'message' => htmlspecialchars($message),
                        ]
        );
    }
}


