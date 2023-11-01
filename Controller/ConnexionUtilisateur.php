<?php
include_once('../Model/DataBase.php');
include_once('../Model/Utilisateur.php');
date_default_timezone_set('Africa/Dakar');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

   Utilisateur::connexionUtilisateur($email, $password,$db);

}
?>