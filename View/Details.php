
<?php
require_once('../Controller/DetailContact.php');
$contacts =  Contact::listerContact($db);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>Document</title>
</head>
<body>
<!-- <div class="liste_contact"> -->
            <h2>Liste des Contact</h2>
            <table class="tableau_contact">
                <thead>
                    <tr>
                        <th colspan="6">Contact de <?php echo $contact['nom'] .' '. $contact['prenom']; ?></th>
                    </tr>
                    <tr>
                        <th>Nom </th>
                        <th>Prenom </th>
                        <th>Téléphone</th>
                        <th>Favori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $contact['nom']; ?></td>
                        <td><?php echo $contact['prenom']; ?></td>
                        <td><?php echo $contact['numeroTel']; ?></td>
                        <td><?php echo $contact['favori']; ?></td>
                        <td class="termine_supprime">
                        <div class="form-container">
                            <form action="" method="POST" class="form-terminer">
                                <input type="hidden" name="contact_id" value="<?php echo $contact['idContact']; ?>">
                                <button type="submit" name="marquer_favori">Marquer favori</button>
                            </form>
                        </div>
                        <div class="form-container">
                            <form action="" method="POST" class="form-supprimer">
                                <input type="hidden" name="contact_id" value="<?php echo $contact['idContact']; ?>">
                                <button type="submit" name="supprimer_contact" class="supprimer_contact">Supprimer</button>
                            </form>
                        </div>
                            <button type="submit" name="voir_details"><a href="modifier_contact.php?contact_id=<?php echo $contact['idContact']; ?>" class="modifier_contact">Modifier</a></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        <!-- </div> -->
        <button type="submit" name="liste_contact"><a href="creationContact.php">liste des contacts</a></button>

</body>
</html>