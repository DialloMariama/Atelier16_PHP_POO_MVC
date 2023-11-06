<?php
session_start();
include_once('../Model/DataBase.php');
include_once('../Model/Utilisateur.php');


$nom="";
$email="";
$password="";
$confirmation_password="";
$erreurs=[];

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST["creer_compte"])){
        $nom= $_POST['nom'];
        $email= $_POST['email'];
        $password= $_POST['password'];
        $confirmation_password= $_POST['confirmation_password'];
        var_dump($email);
        var_dump($password);


        $regex_nom = "/^[a-zA-Z ']{2,}$/";
        if (!preg_match($regex_nom, $_POST["nom"])) {
            $erreurs[] = "Le nom est invalide.";
        }
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            array_push($erreurs, "Entrez un email valide");
        }
        if(!(strlen($password) == 8)){
            
            array_push($erreurs, "le mot de passe doit contenir 8 caracteres");
        }
        if (!empty($erreurs)) {
            echo "<ul>";
            foreach ($erreurs as $erreur) {
                echo "<li style='color: red;'>$erreur</li>";
            }
            echo "</ul>";
        }else{
            if($password === $confirmation_password){
                

                $email_exist= "SELECT COUNT(*) FROM utilisateurs WHERE email = ?";
                $verif_email_exist= $db->prepare($email_exist);
                $verif_email_exist->execute([$email]);
                $count_email_exist = $verif_email_exist->fetchColumn();

                if($count_email_exist === 0){
                    $nouvelUtilisateur = new Utilisateur($nom, $email, $password);
            
                     $inscriptionReussie = $nouvelUtilisateur->inscriptionUtilisateur($db);
    
                echo "Inscription reussie";
        
                }else{
                    echo "<li style='color: red;'>Cet e-mail est déjà enregistré.</li>";
                }
                
            }else{
                echo "<li style='color: red;'>Veuillez saisir le même mot de passe.</li>";
            }
            
        }
    }

    // if(isset($_POST["se_connecter"])){
    //     $email= $_POST['email'];
    //     $password= md5($_POST['password']);


    //     $connexion="SELECT * FROM utilisateurs WHERE email = ? AND password = ?";
    //     $stmt=$db->prepare($connexion);
    //     $stmt->execute([$email, $password]);
    //     $utilisateur=$stmt->fetch(PDO::FETCH_ASSOC);

    //     if($utilisateur){
    //         $_SESSION['utilisateur_id'] = $utilisateur['id'];
    //         $_SESSION['utilisateur_nom'] = $utilisateur['nomUtilisateur'];
           
    //         // header('Location: creationContact.php'); 
            
    //     }else{
    //         echo "echec de connexion";
    //     }

    // }
    
}



?>