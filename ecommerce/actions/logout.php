<?php

require_once '../DBManager.php';
require_once '../classes/user.php';
require_once '../classes/session.php';

session_start();

$current_user = $_SESSION['current_user'];

if($current_user==null)
{
    header("Location: ../views/login.php");
    exit;
}

$session = Session::Find($current_user->getId());

if ($current_user) {
    $_SESSION['current_user'] = null;
    $session->Delete();
    header('Location: ../views/login.php');
    exit;
}
