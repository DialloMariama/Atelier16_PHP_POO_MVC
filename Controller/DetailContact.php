

<?php
    // include_once('AjoutContact.php');

    // if (isset($_GET['contact_id'])) {
    //     $contact_id = $_GET['contact_id'];

    //     $requete = "SELECT * FROM contact WHERE idContact = ?";
    //     $stmt = $db->prepare($requete);
    //     $stmt->execute([$contact_id]);
    //     $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if (isset($contact)) {
    //         // j'ai affiché le resultat dans le tableau HTML
    //     } else {
    //         echo "Tâche non trouvée.";
    //     }
    // } else {
    //     echo "Paramètre contact_id manquant.";
    // }

    
// if (isset($_POST['marquer_favori'])) {
//     $contact_id = $_POST['contact_id'];

//     $update_query = "UPDATE contact SET favori = 'oui' WHERE idContact = ?";
//     $stmt = $db->prepare($update_query);
//     $stmt->execute([$contact_id]);
//     if($favori == "oui"){
//         echo "Ce contact est déja favori";
//     }else{
//         header('Location: Details.php?contact_id=' . $contact_id);
//         exit;
//     }

    
// }

// if (isset($_POST['supprimer_contact']) && isset($_POST['contact_id'])) {
//     $contact_id = $_POST['contact_id'];

//     $delete_query = "DELETE FROM contact WHERE idContact = ?";
//     $stmt = $db->prepare($delete_query);

//     if ($stmt->execute([$contact_id])) {
//         header('Location: creationContact.php');
//         exit;
//     }
// }

?>
