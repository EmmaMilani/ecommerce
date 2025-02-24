<?php
require_once "../DBManager.php";
class User
{
    private $id;
    private $email;
    private $password;
    private $role_id;

    function setPassword($value){$this->password = $value;}
    function setEmail($value){$this->email = $value;}
    function getId(){return $this->id;}
    function getPassword(){return $this->password;}
    function getEmail(){return $this->email;}
    public function getRoleId(){ return $this->role_id;}

    public static function Find($id)
    {
        $db = new DBManager('localhost', 3306, 'emma', '291569Fab05');
        $pdo = $db->Connect("ecommerce");
        $stm = $pdo->prepare("select * from ecommerce.users where id=:id");
        $stm->bindParam(":id", $id);
        if ($stm->execute()) {
            return $stm->fetchObject("User");
        } else {
            throw new PDOException("Errore nella find");
        }
    }

}