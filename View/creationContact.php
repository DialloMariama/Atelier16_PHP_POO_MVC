<?php 

include_once('../Controller/AjoutContact.php');
// include_once('../Controller/ConnexionUtilisateur.php');
$contacts =  Contact::listerContact($db);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Créer un Contact</title>
</head>

<body>
    <div class="gestion_contact">
        <div class="ajout_contact">
            <h2>Ajouter un nouveau contact</h2>
            <form action="" method="post">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" ><br><br>

                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom"><br><br>

                <label for="numeroTel">Téléphone</label>
                <input type="number" id="numeroTel" name="numeroTel"><br><br>

                <label for="favori">Favori:</label>
                <select id="favori" name="favori">
                    <option value="selectionnez" disabled selected>Selectionnez</option>
                    <option value="oui">OUI</option>
                    <option value="non">NON</option>
                </select><br><br>

                <button type="submit" name="creer_contact">Ajouter</button>
            </form>
            <form action="" method="post">
            <button type="submit" name="deconnexion">Se déconnecter</button>
            </form>
        </div>
        <div class="liste_contact">
            <h2>Liste des contacts</h2>
            <table class="tableau_contact">
                <thead>
                
                    <tr>
                        <th colspan="6">Liste des contacts de <?php echo $_SESSION['utilisateur_nom']; ?></th>
                    </tr>
                    <tr>
                        <th>Nom </th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Favori</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <?php foreach ($contacts as $contact) : ?>
                <tbody>
                    <tr>
                        <td><?php echo $contact['nom']; ?></td>
                        <td><?php echo $contact['prenom']; ?></td>
                        <td><?php echo $contact['numeroTel']; ?></td>
                        <td><?php echo $contact['favori']; ?></td>
                        <td><button type="submit" name="voir_details"><a href="Details.php?contact_id=<?php echo $contact['idContact']; ?>">Voir détails</a></button></td>
                    </tr>
                </tbody>
                <?php endforeach; ?>

            </table>
        </div>

    </div>
</body>

</html>