<?php
require_once "../DBManager.php";
require_once "../classes/user.php";
require_once "../classes/session.php";
require_once "../classes/cart.php";

$email = $_POST["email"];
$password = hash('sha256',$_POST["password"]);


$database = new DBManager("localhost", "3306", "emma", "291569Fab05");
$pdo = $database->connect("ecommerce");

$stm = $pdo->prepare("select * from ecommerce.users where email=:email and password=:password limit 1");
$stm->bindParam(":email", $email);
$stm->bindParam(":password", $password);
$stm->execute();
$current_user = $stm->fetchObject("User");

if ($current_user) {
    session_start();
    $params=array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $current_user->getId());
    Session::Create($params);
    $_SESSION['current_user'] = $current_user;
    header('Location: ../views/products.php');
    exit;
} else {
    header('Location: ../views/login.php');
    exit;
}