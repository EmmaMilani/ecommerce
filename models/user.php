<?php

namespace models;

require_once "../database.php";

class user
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    private $email;
    private $password;

    /*public static function Find($id)

    {
        $database = new database("192.168.1.5", "3306", "cristiano", "password");
        $pdo = $database->connect("ecommerce5E");
        $stm = $pdo->prepare("select * from sessions where id=:id");
        $stm->bindParam("id", $id);
        if ($stm->execute()) {
            return $stm->fetchObject("session");
        } else {
            throw new PDOException("Errore nella find");
        }
    }*/
}

