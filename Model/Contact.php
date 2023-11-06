<?php
// session_start();
require_once('../Controller/IContact.php');

class Contact implements IContact{
    private $nom;
    private $prenom;
    private $numeroTel;
    private $favori;

    public function setNom($nom){
        if (!preg_match('/^[a-zA-Z \']{2,}$/', $nom)) {
            throw new Exception("Le nom est invalide. Il doit contenir uniquement des lettres");
        }

        $this->nom= $nom;
    }
    public function getNom(){
        return  $this->nom;
        
    }
    public function setPrenom($prenom){
        if (!preg_match('/^[a-zA-Z \']{3,}$/', $prenom)) {
            throw new Exception("Le prenom est invalide. Il doit contenir uniquement des lettres.");
        }
        $this->prenom = $prenom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function setNumeroTel($numeroTel){
        if (!preg_match("/^(70|75|76|77|78)[0-9]{7}$/", $numeroTel)) {
            throw new Exception("Le numéro de téléphone doit contenir exactement 9 chiffres et respecter les operateurs existant par ex: 70.");
        }
        $this->numeroTel = $numeroTel;
    }
    public function getNumeroTel(){
        return $this->numeroTel;
    }

    public function setFavori($favori){
        if (empty($favori)) {
            throw new Exception("Veillez choisir une valeur. il ne peut pas être vide.");
        }

        $this->favori= $favori;
    }
    public function getFavori(){
        return $this->favori;
    }

    public function __construct($nom, $prenom, $numeroTel, $favori){
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setNumeroTel($numeroTel);
        $this->setFavori($favori);


    }


    public function ajoutContact($db,$idUtilisateur){
        $nom = $this->getNom();
        $prenom = $this->getPrenom();
        $numeroTel = $this->getNumeroTel();
        $favori = $this->getFavori();
       
        $insertion = "INSERT INTO contact(idUtilisateur, nom, prenom, numeroTel, favori) values (?, ?, ?, ?, ?)";
        $stmt=$db->prepare($insertion);
        $stmt->execute([$idUtilisateur, $nom, $prenom, $numeroTel, $favori]);


    }
    public static function GetContact($bd,$contact_id){
        $contact="SELECT * FROM contact WHERE idContact=$contact_id";
        return $bd->query($contact)->fetch();
    }
    public static function modifierContact($bd, $contact_id, $nom, $prenom, $numeroTel, $favori){
      
        $modif="UPDATE contact SET nom= ?,prenom= ?,numeroTel= ?, favori= ? WHERE idContact=?";
        $stmt=$bd->prepare($modif);
        $stmt->execute([$nom, $prenom, $numeroTel, $favori,$contact_id]);
        echo "Modification réussi";
    }
   
    public static function listerContact($db, $idUtilisateur){
    
    
            $sql = "SELECT * FROM contact WHERE idUtilisateur = ?";
            $stmt=$db->prepare($sql);
            $stmt->execute([$idUtilisateur]);
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $contacts;
        

    }
    public function SupprimerContact(){

    }
    
}