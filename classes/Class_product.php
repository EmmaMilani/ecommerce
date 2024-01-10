<?php

require_once "..\DBManager.php";
class Product
{
    private $id;
    private $nome;
    private $marca;
    private $prezzo;

    function GetId(){return $this->id;}
    function GetNome(){return $this->nome;}
    function GetMarca(){return $this->marca;}
    function GetPrezzo(){return $this->prezzo;}

    function SetNome($value){$this->nome = $value;}
    function SetMarca($value){$this->marca = $value;}
    function SetPrezzo($value){$this->prezzo = $value;}

    private static function connector() {
        $database = new DBManager("localhost", "3306", "root", "");
        return $database->connect("ecommerce");
    }
    public static function fetchAll() {

        $ecommerce = Product::connector();

        $sql = "select * from ecommerce.products";
        return $ecommerce->query($sql)->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function find($id) {
        $sql = "select * from ecommerce.products where id = $id";
        return Product::connector()->query($sql)->fetchObject('Product');
    }

    public function save($id)
    {

    }
}
?>