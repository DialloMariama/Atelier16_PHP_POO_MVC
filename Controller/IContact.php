<?php

interface IContact{

    public function ajoutContact($db);
    public static function  modifierContact();
    public static function  listerContact($db);
    public function SupprimerContact();


}