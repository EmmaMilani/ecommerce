<?php
// mappa la tabella session
//creazione sessione -> create statico
//distruggere la sessione -> delete di istanza

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

    static function create($params)
    {
        $db = new DBManager("192.168.3.36", "3306", "root", "" );
        $pdo = $db->Connect("ecommerce");
        $data = date("j, n, Y");
        $stm = $pdo->prepare("insert into ecommerce.sessions (ip, data_login, id_utente) value (:ip, :data_login, :id_utente)");
        $stm ->bindParam(":ip", $_SERVER["REMOTE_HOST"]);
        $stm ->bindParam(":data_login", $data);
        $stm ->bindParam(":id_utente", $params["id_utente"]);
    }

    public static function Find($id)
    {
        $db = new DBManager('localhost', 3306, 'root', '');
        $pdo = $db->Connect("ecommerce");
        $stm = $pdo->prepare("select * from ecommerce.sessions where id=:id");
        $stm->bindParam(":id", $id);
        if ($stm->execute()) {
            return $stm->fetchObject("Session");
        } else {
            throw new PDOException("Errore nella find");
        }
    }
}