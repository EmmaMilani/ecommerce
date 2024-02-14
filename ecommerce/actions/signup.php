<?php
require_once "../DBManager.php";
require_once "../classes/user.php";
require_once "../classes/session.php";

$email = $_POST["email"];
$password = $_POST["password"];


$database = new DBManager("localhost", "3306", "emma", "291569Fab05");
$pdo = $database->connect("ecommerce");

$stm = $pdo->prepare("insert into ecommerce.users(email, password, role_id) values (:email, SHA2(:password, 256), 1)");
$stm->bindParam(":email", $email);
$stm->bindParam(":password", $password);
if($stm->execute()) {
    header('Location: ../views/login.php');
    exit;
} else {
    header('Location: ../views/signup.php');
    exit;
}