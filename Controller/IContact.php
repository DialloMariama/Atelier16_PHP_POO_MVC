<?php

interface IContact{

    public function ajoutContact($db,$idUtilisateur);
    public static function  modifierContact($bd, $idContact, $nom, $prenom, $numeroTel, $favori);
    public static function  listerContact($db, $idUtilisateur);
    public function SupprimerContact();


}