<?php

require_once "../../DBManager.php";
require_once "../../classes/Class_user.php";

//devo crontrollare che sia un admin

$database = new DBManager("192.168.3.36", "3306", "root", "");
$pdo = $database->connect("ecommerce");

