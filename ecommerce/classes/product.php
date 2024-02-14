<?php

require_once "../DBManager.php";
require_once "cart_product.php";
class Product
{
    private $id;
    private $nome;
    private $marca;
    private $prezzo;

    function getId(){return $this->id;}
    function GetNome(){return $this->nome;}
    function GetMarca(){return $this->marca;}
    function GetPrezzo(){return $this->prezzo;}

    function SetNome($value){$this->nome = $value;}
    function SetMarca($value){$this->marca = $value;}
    function SetPrezzo($value){$this->prezzo = $value;}

    private static function connector() {
        $database = new DBManager("localhost", "3306", "emma", "291569Fab05");
        return $database->connect("ecommerce");
    }
    public static function fetchAll() {

        $ecommerce = Product::connector();
        $sql = "select * from ecommerce.products";
        return $ecommerce->query($sql)->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function Create($nome, $marca, $prezzo)
    {
        $ecommerce = Product::connector();
        try {
            $stmt = $ecommerce->prepare("INSERT INTO ecommerce.products (nome, marca, prezzo) VALUES (:nome, :marca, :prezzo)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':prezzo', $prezzo);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Errore durante l'inserimento del prodotto: " . $e->getMessage());
        }
    }

    public function GetProduct() {
        $conn = Product::connector();
        $id = $this->getId();
        $sql = $conn->prepare("select * from ecommerce.products where id=:id limit 1");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql->fetchObject('Product');
    }

    public static function find($id) {
        $ecommerce  = Product::connector();
        $sql = "select * from ecommerce.products where id = :id";
        $stmt = $ecommerce->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchObject('Product');
    }
    public static function UpdateProduct($id, $nome, $marca, $prezzo)
    {
        $ecommerce  = Product::connector();
        $sql = "update ecommerce.products set nome = :nome, marca = :marca, prezzo = :prezzo where id = :id";
        $stmt = $ecommerce->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":prezzo", $prezzo);
        return $stmt->execute();
    }
}
