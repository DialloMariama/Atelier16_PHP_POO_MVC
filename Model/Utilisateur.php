<?php

require_once('../Controller/IUtilisateur.php');


class Utilisateur implements IUtilisateur{
    private $nom;
    private $email;
    private $password;
    

    public function setNom($nom){
        if (!preg_match('/^[a-zA-Z \']{2,}$/', $nom)) {
            throw new Exception("Le nom est invalide. Il doit contenir uniquement des lettres");
        }

        $this->nom= $nom;
    }
    public function getNom(){
        return $this->nom;
    }

    public function setEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email= $email;            
        }else{
            throw new Exception("Error Processing Request");

        }        
    }
    public function getEmail(){
        return $this->email;
    }

    public function setMotDetPasse($password){
        if (strlen($password) == 8 && is_string($password)) {

            $this->password= $password;
        }else{
            throw new Exception("Le mot de passe doit comporeter exactement 8 caractéres");
            
        }
       
    }
    public function getMotDetPasse(){
        return $this->password;
    }
    
    public function __construct($nom, $email, $password){
        $this->setNom($nom);
        $this->setEmail($email);
        $this->setMotDetPasse($password);

    }


    public function inscriptionUtilisateur($db) {
        $nom = $this->getNom();
        $email = $this->getEmail();
        $password = $this->getMotDetPasse();

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $date_inscription = date("Y-m-d H:i:s");

        $sql = "INSERT INTO utilisateurs (nomUtilisateur, email, password, dateInscription) VALUES (?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->execute([$nom,$email, $passwordHash,$date_inscription]);

        return true; 
    }
    
    public static function connexionUtilisateur($email, $password,$db) {
        

        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($password, $utilisateur['password'])) {
            $_SESSION['utilisateur'] = $utilisateur;
            // $_SESSION['utilisateur_id'] = $utilisateur['id'];
            // $_SESSION['utilisateur_nom'] = $utilisateur['nomUtilisateur'];


            echo "Coucou ";
            header('Location: creationContact.php'); 
        } else {
      
            $messageErreur = "Adresse e-mail ou mot de passe incorrect.";
            echo $messageErreur;
        }
    }
    public static function consulterListeUtilisateurs() {
        global $db; 

        $sql = "SELECT * FROM utilisateurs";
        $stmt = $db->query($sql);
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $utilisateurs;
    }
}

?>