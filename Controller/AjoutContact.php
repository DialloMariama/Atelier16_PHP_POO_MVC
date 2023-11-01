<?php
session_start();
include_once('../Model/DataBase.php');
include_once('../Model/Contact.php');


$nom="";
$prenom="";
$numeroTel="";
$favori="";
$_SESSION['utilisateur_id'];
$_SESSION['utilisateur_nom'] ;

$erreurs=[];



if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST["creer_contact"])){
        $nom= $_POST['nom'];
        $prenom= $_POST['prenom'];
        $numeroTel= $_POST['numeroTel'];
        $favori= $_POST['favori'];
        $idUtilisateur= $_SESSION['utilisateur_id'];
    
        // var_dump($nom);
        // var_dump($prenom);
        // var_dump($numeroTel);
        // var_dump($favori);
        // var_dump($idUtilisateur);



        $regex_nom = "/^[a-zA-Z ']{2,}$/";
        $regex_prenom = "/^[a-zA-Z ']{3,}$/";

        if (!preg_match($regex_nom, $_POST["nom"])) {
            $erreurs[] = "Le nom est invalide.";
        }
        if (!preg_match($regex_prenom, $_POST["prenom"])) {
            $erreurs[] = "Le prenom est invalide.";
        }
        if (!preg_match("/^(70|75|76|77|78)[0-9]{7}$/", $numeroTel)) {
            array_push($erreurs, "Le numéro de téléphone doit contenir exactement 9 chiffres et respecter les operateurs existant par ex: 70.");
        }
        if (empty($favori)) {
            array_push($erreurs, "Veuillez sélectionner une priorité.") ;
        }
       
        if (!empty($erreurs)) {
            echo "<ul>";
            foreach ($erreurs as $erreur) {
                echo "<li style='color: red;'>$erreur</li>";
            }
            echo "</ul>";
        }else{
            
                
            $numeroTel_exist = "SELECT COUNT(*) FROM contact WHERE numeroTel = ?";
            $stmt_numeroTel_exist = $db->prepare($numeroTel_exist);
            $stmt_numeroTel_exist->execute([$numeroTel]);
            $count_numeroTel_exist = $stmt_numeroTel_exist->fetchColumn();

                if($count_numeroTel_exist === 0){
                    $nouveauContact = new Contact($nom, $prenom, $numeroTel, $favori);
            
                     $insertionReussie = $nouveauContact->ajoutContact($db);
    
                     if ($insertionReussie) {
                        echo "Insertion reussie";
                        exit;
                    } else {
                        echo "Insertion echouée";
                        
                    }
                
            
            }
    
    
        }


    }
}

if (isset($_SESSION['utilisateur_id'])) {
       
    $requete = "SELECT * FROM contact WHERE idUtilisateur = ?";

    $stmt = $db->prepare($requete);
    $stmt->execute([$_SESSION['utilisateur_id']]);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // header('Location: interface_utilisateur.php');
        // exit();
    }
?>