<?php
require_once "../DBManager.php";
require_once "user.php";
class Cart_product
{
    private $id;
    private $cart_id;
    private $product_id;
    private $quantita;
    public function getId() { return $this->id;}
    public function getCartId(){ return $this->cart_id;}
    public function setCartId($cart_id): void { $this->cart_id = $cart_id;}
    public function getProductId() { return $this->product_id;}
    public function setProductId($product_id): void { $this->product_id = $product_id;}
    public function getQuantita(){ return $this->quantita;}
    public function setQuantita($quantita): void { $this->quantita = $quantita;}

    private static function connect() {
        $database = new DBManager("localhost", "3306", "emma", "291569Fab05");
        return $database->connect("ecommerce");
    }
    public static function fetchAll($current_user) {
        $user_id = $current_user->getId();
        $conn = cart_product::connect();
        $sql = $conn->prepare("SELECT cp.cart_id, cp.product_id, cp.quantita FROM ecommerce.cart_products cp INNER JOIN ecommerce.carts c ON c.id = cp.cart_id WHERE c.user_id = :user_id");
        $sql->bindParam(":user_id", $user_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    function GetProduct()
    {
        $conn = Cart_product::connect();
        $productId = $this->getProductId();
        $sql = $conn->prepare("select * from ecommerce.products where id=:id");
        $sql->bindParam(":id", $productId);
        $sql->execute();
        return $sql->fetchObject('Product');
    }

    public static function find_by_product($product_id, $user_id) {
        $conn = cart_product::connect();
        $sql = $conn->prepare("SELECT cp.cart_id, cp.product_id, cp.quantita FROM ecommerce.cart_products cp INNER JOIN ecommerce.carts c on cp.cart_id = c.id WHERE cp.product_id = :product_id AND c.user_id = :user_id");
        $sql->bindParam(":product_id", $product_id);
        $sql->bindParam(":user_id", $user_id);
        $sql->execute();
        return $sql->fetchObject(__CLASS__);
    }

    public static function add_to_cart_products($cart_id, $productId, $quantita):void{
        $conn = cart_product::connect();
        $sql = $conn->prepare("insert into ecommerce.cart_products (cart_id, product_id, quantita) values (:cart_id, :product_id, :quantita)");
        $sql->bindParam(':cart_id', $cart_id);
        $sql->bindParam(':product_id', $productId);
        $sql->bindParam(':quantita', $quantita);
        $sql->execute();
    }

    public function save()
    {
        $quantita = $this->getQuantita();
        $product_id = $this->getProductId();
        $cart_id = $this->getCartId();

        $conn = Cart_product::connect();

        $sql = $conn->prepare("update ecommerce.cart_products set quantita =:quantita where cart_id = :cart_id and product_id = :product_id");
        $sql->bindParam(':quantita', $quantita);
        $sql->bindParam(':cart_id', $cart_id);
        $sql->bindParam(':product_id', $product_id);

        return $sql->execute();
    }

    public function delete_product()
    {
        $conn = Cart_product::connect();
        $cartId = $this->getCartId();
        $product_id = $this->getProductId();
        $stmt = $conn->prepare("DELETE FROM ecommerce.cart_products WHERE cart_id = :cart_id AND product_id = :product_id");
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
    }
}