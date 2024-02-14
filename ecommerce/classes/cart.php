<?php

require_once "..\DBManager.php";
require_once "user.php";
class Cart
{
    private $id;
    private $id_utente;
    private $id_carrello;
    private $id_prodotto;
    private $quantita;

    function getId(){return $this->id;}
    function GetIdUtente(){return $this->id_utente;}
    function GetIdCarrello(){return $this->id_carrello;}
    function GetIdProdotto(){return $this->id_prodotto;}
    function GetQuantita(){return $this->quantita;}
    function SetIdUtente($value){$this->id_utente = $value;}
    function SetIdCarrello($value){$this->id_carrello = $value;}
    function SetIdProdotto($value){$this->id_prodotto = $value;}
    function SetQuantita($value){$this->quantita = $value;}

    private static function connect()
    {
        $database = new DBManager("localhost", "3306", "emma", "291569Fab05");
        return $database->connect("ecommerce");
    }

    public static function Create($user_id)
    {
        $conn = Cart::connect();
        $stmt = $conn->prepare("INSERT INTO ecommerce.carts (user_id) VALUES (:user_id)");
        $stmt->bindParam(":user_id", $user_id);
        if ($stmt->execute()) {
            $stmt = $conn->prepare("select * from ecommerce.carts where user_id=:user_id");
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            return $stmt->fetchObject('Cart');
        } else {
            throw new PDOException("Errore");
        }
    }

    public static function find_product($product_id, $cart_id)
    {
        $conn = Cart::connect();
        $sql = $conn->prepare("select * from ecommerce.cart_products where product_id=:id_prodotto and cart_id=:cart_id");
        $sql->bindParam(":id_prodotto", $product_id);
        $sql->bindParam(":cart_id", $cart_id);
        $sql->execute();
        return $sql->fetchObject('Cart_product');
    }

    public static function find_cart($user_id){
        $conn = Cart::connect();
        $stmt = $conn->prepare("select * from ecommerce.carts where user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        if ($stmt->execute()) {
            return $stmt->fetchObject("Cart");
        } else {
            return false;
        }
    }
}