<?php 

include_once('../Controller/AjoutContact.php');
$contacts =  Contact::listerContact($db, $idUtilisateur);
if(isset ($_SESSION['utilisateur'])){


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Créer un Contact</title>
</head>

<body>
    <div class="container m-4">
        <div class="card">
            <div class="row ">

                <div class="col">
                <h2 class="card-header text-center bg-primary text-white ">Ajouter un nouveau contact</h2>
                    <form action="" method="post">
                        <div class="card-body">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control">

                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control">

                            <label for="numeroTel">Téléphone</label>
                            <input type="number" id="numeroTel" name="numeroTel" class="form-control">

                            <label for="favori">Favori:</label>
                            <select id="favori" name="favori" class="form-control">
                                <option value="selectionnez" disabled selected>Selectionnez</option>
                                <option value="oui">OUI</option>
                                <option value="non">NON</option>
                            </select>

                            <button type="submit" name="creer_contact" class="btn btn-primary mt-2 offset-5">Ajouter</button>
                        </div>
                    </form>
                    <form action="" method="post">
                    <button type="submit" name="deconnexion" class="btn btn-dark mt-3 offset-0">Se déconnecter</button>
                    </form>
                </div>
                <div class="col md-4">
                    <h2 class="card-header text-center bg-dark text-white ">Liste des contacts</h2>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                            
                                <tr>
                                    <th colspan="6">Liste des contacts de <?php echo $_SESSION['utilisateur']['nomUtilisateur']; ?></th>
                                </tr>
                                <tr>
                                    <th>Nom</th>
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
                                    <td class="termine_supprime">
                                        <form action="" method="POST" class="form-terminer">
                                            <?php if($contact['favori']=="Oui"){ ?>
                                                <input type="hidden" name="contact_id" value="<?php echo $contact['idContact']; ?>">
                                                <button type="submit" name="supprimer_contact" class="btn btn-danger"> 🗑</button>
                                            <button type="submit" name="voir_details" class="btn btn-success"><a href="modificationContact.php?contact_id=<?php echo $contact['idContact']; ?>" class="text-white ">Modifier ✏</a></button>
                                            <?php }else{ ?>
                                                
                                                
                                                <input type="hidden" name="contact_id" value="<?php echo $contact['idContact']; ?>">
                                                <button type="submit" name="marquer_favori" class="btn btn-dark">⭐</button>
                                        
                                                <input type="hidden" name="contact_id" value="<?php echo $contact['idContact']; ?>">
                                                <button type="submit" name="supprimer_contact" class="btn btn-danger"> 🗑</button>
                                        
                                                <button type="submit" name="voir_details" class="btn btn-success "><a href="modificationContact.php?contact_id=<?php echo $contact['idContact']; ?>" class="text-white ">Modifier ✏</a></button>
                                    
                                                
                                                <?php }?>
                                            
                                        
                                        </form>

                                    </td>
                                </tr>
                            </tbody>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php }else{
    header('Location:creationUtilisateur.php');
    
}?>