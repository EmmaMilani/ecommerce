<?php

require_once "../DBManager.php";
class Session
{
    private $id;
    private $ip;
    private $data_login;

    public function getDataLogin(){return $this->data_login;}
    public function setDataLogin($value){$this->data_login = $value;}
    public function getIp(){return $this->ip;}
    public function setIp($value){$this->ip = $value;}
    public function getId(){return $this->id;}

    private static function connect()
    {
        $database = new DBManager("localhost", "3306", "emma", "291569Fab05");
        return $database->connect("ecommerce");
    }
    static function Create($params)
    {
        $pdo = Session::connect();
        $data = date("Y-m-d H:i:s");
        $stm = $pdo->prepare("insert into ecommerce.sessions (ip, data_login, user_id) value (:ip, :data_login, :id_utente)");
        $stm ->bindParam(":ip", $params["ip"]);
        $stm ->bindParam(":data_login", $data);
        $stm ->bindParam(":id_utente", $params["user_id"]);
        $stm->execute();
    }

    public static function Find($user_id)
    {
        $pdo = self::Connect();
        $stmt = $pdo->prepare("SELECT * FROM ecommerce.sessions WHERE user_id = :user_id ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchObject("Session");
    }

    public function Delete()
    {
        $pdo = self::Connect();
        $id = $this->getId();
        $stmt = $pdo->prepare("DELETE FROM ecommerce.sessions WHERE user_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}