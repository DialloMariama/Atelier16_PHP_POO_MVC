<?php
session_start();
include_once('../Model/DataBase.php');
include_once('../Model/Contact.php');


$nom="";
$prenom="";
$numeroTel="";
$favori="";
$idUtilisateur = $_SESSION['utilisateur']['id'];

$erreurs=[];



if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST["creer_contact"])){
        $nom= $_POST['nom'];
        $prenom= $_POST['prenom'];
        $numeroTel= $_POST['numeroTel'];
        $favori= $_POST['favori'];
        $idUtilisateur= $_SESSION['utilisateur']['id'];

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
            
                     $insertionReussie = $nouveauContact->ajoutContact($db,$idUtilisateur);
    
                     if ($insertionReussie) {
                        echo "Insertion echouée";
                    } else {
                        echo "Insertion reusse";
                        
                    }
                }else{
                    echo "Ce numero de telephone existe dejà";

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

    if (isset($_GET['contact_id'])) {
        $contact_id = $_GET['contact_id'];

        $requete = "SELECT * FROM contact WHERE idContact = ?";
        $stmt = $db->prepare($requete);
        $stmt->execute([$contact_id]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($contact)) {
            // j'ai affiché le resultat dans le tableau HTML
        } else {
            echo "Contact non trouvé.";
        }
    } else {
       // echo "Paramètre contact_id manquant.";
    }

    
if (isset($_POST['marquer_favori'])) {
    $contact_id = $_POST['contact_id'];

    $update_query = "UPDATE contact SET favori = 'oui' WHERE idContact = ?";
    $stmt = $db->prepare($update_query);
    $stmt->execute([$contact_id]);
   
        header('Location: creationContact.php?contact_id=' . $contact_id);
        exit;

    
}

if (isset($_POST['supprimer_contact']) && isset($_POST['contact_id'])) {
    $contact_id = $_POST['contact_id'];

    $delete_query = "DELETE FROM contact WHERE idContact = ?";
    $stmt = $db->prepare($delete_query);

    if ($stmt->execute([$contact_id])) {
        header('Location: creationContact.php');
        exit;
    }
}

if(isset($_POST['modifier'])){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $numeroTel=$_POST['numeroTel'];
    $favori=$_POST['favori'];

    if(empty($nom) || empty($prenom) ||empty($numeroTel) || empty($favori)){
        echo "Veuillez renseigner tous les champs !!!";
    }else{
        $contact= new Contact($nom,$prenom,$numeroTel,$favori);
        $contact->ModifierContact($db,$_GET['contact_id'],$nom, $prenom, $numeroTel, $favori);
        header("location:../View/CreationContact.php");
    }
}

    if (isset($_POST['deconnexion'])) {
        if (isset($_SESSION['utilisateur']['id'])) {
            unset ( $_SESSION['utilisateur']);
            session_destroy();
            header('Location: creationUtilisateur.php'); 
            exit();
        }
    }
?>