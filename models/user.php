<?php
include_once('../db_config/config.php');


class User
{
    private $bdd;
    private $connected;

    function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASSWORD, [
                                                                      PDO::ATTR_ERRMODE =>
                                                                          PDO::ERRMODE_EXCEPTION,
                                                                  ]
            );
            $this->bdd->exec('SET CHARACTER SET utf8');
            $this->connected = false;
        } catch (Exception $e) {
            die('ERREUR : Impossible de se connecter à la base de donnée.' . $e->getMessage());
        }
    }

    public function connect($login, $password)
    {
        $query = $this->bdd->query("SELECT password FROM User WHERE login = '$login'");
        $pass  = $query->fetch()[0];
        if ($password == $pass) {
            $this->connected = true;
            $this->setStatus($login, 1);
        }
        return $this->connected;
    }

    public function exist($login)
    {
        $query = $this->bdd->query("SELECT password FROM User WHERE login = '$login'");
        if ($query->fetch()[0]) {
            return true;
        }
        return false;
    }

    public function create($login, $password)
    {
        if (!$this->exist($login)) {

            try {
                $query = $this->bdd->prepare('INSERT INTO user(login, password) VALUES(:login, :password)');
                $query->execute([
                                    'login'   => htmlspecialchars($login),
                                    'password' => htmlspecialchars($password),
                                ]
                );
                $this->setStatus($login, 1);
                return true;
            } catch (Exception $e) {
                die('ERREUR : Impossible de se creer l\'utilisateur' . $e->getMessage());
            }
        }
        return false;

    }

    public function setStatus($login, $status)
    {
        try {
            $query = $this->bdd->prepare('UPDATE user SET status = :status WHERE login = :login');
            $query->execute([
                                'login' => htmlspecialchars($login),
                                'status' => htmlspecialchars($status),
                            ]
            );
            return true;
        } catch (Exception $e) {
            die('ERREUR : Impossible de modifier l\'état de l\'utilisateur' . $e->getMessage());
        }
        return false;
    }

    public function getAllUsers()
    {
        $users = [];
        $query    = $this->bdd->query('SELECT login FROM user WHERE status=1 ORDER BY id DESC');
        $i        = 0;
        while ($data = $query->fetch()) {
            $users[$i] = $data;
            $i++;
        }
        return $users;
    }
}


