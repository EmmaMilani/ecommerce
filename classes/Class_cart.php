<?php
require_once "..\DBManager.php";
class Cart
{
    private $id;
    private $id_utente;
    private $id_carrello;
    private $id_prodotto;
    private $quantita;

    function GetId(){return $this->id;}
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
        $database = new DBManager("localhost", "3306", "root", "");
        return $database->connect("ecommerce");
    }

    public function getProdotto()
    {
        $conn = Cart::connect();
        $sql = $conn->prepare("select * from ecommerce.products where id=:id limit 1");
        $sql->bindParam(":id", $this->id_prodotto);
        $sql->execute();

        return $sql->fetchObject('Product');
    }

    public function delete()
    {
        $conn = Cart::connect();
        $sql = $conn->prepare("delete from ecommerce.carts where id=:id");
        $sql->bindParam(":id", $this->id);
        return $sql->execute();
    }

    public function save()
    {
        $quantita = $this->GetQuantita();
        $product_id = $this->GetIdProdotto();
        $cart_id = $this->GetIdCarrello();

        $conn = Cart::connect();

        $sql = $conn->prepare("update ecommerce.carts_products set quantita =:quantita, id_prodotto = :product_id where id_carrello = :cart_id");
        $sql->bindParam(':quantita', $quantita);
        $sql->bindParam(':id_carrello', $cart_id);
        $sql->bindParam(':id_prodotto', $product_id);

        return $sql->execute();
    }

    public function fetchAll($current_user)
    {
        $user_id = $current_user->getId();
        $conn = Cart::connect();
        $sql = $conn->prepare("select * from ecommerce.carts where id_utente=:user_id");
        $sql->bindParam(":id_utente", $user_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_CLASS, 'Cart');
    }

    public static function find_by_product($product_id)
    {
        $conn = Cart::connect();
        $sql = $conn->prepare("select * from ecommerce.carts_products where id_prodotto=:product_id");
        $sql->bindParam(":id_prodotto", $product_id);
        $sql->execute();
        return $sql->fetchObject('Cart');
    }

    public static function find($cart_id)
    {
        $conn = Cart::connect();
        $sql = $conn->prepare("select * from ecommerce.carts where id=:id");
        $sql->bindParam(":id", $cart_id);
        $sql->execute();
        return $sql->fetchObject('Cart');
    }

    public static function add($CartId, $productId, $quantita)
    {
        $conn = Cart::connect();

        $sql = $conn->prepare("insert into ecommerce.carts_products (id_carrello,id_prodotto,quantita) values (:cart_id,:product_id,:quantita)");
        $sql->bindParam(':cart_id', $CartId);
        $sql->bindParam(':product_id', $productId);
        $sql->bindParam(':quantita', $quantita);
        $sql->execute();
    }
}

?>