<?php

include_once('../Controller/InscriptionUtilisateur.php');
include_once('../Controller/ConnexionUtilisateur.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
    <h1>Création de compte et connexion</h1>
<div class="form-container">
        <form action="" method="post" class="form" id="inscription-form">
            <h2>Créer un compte</h2>
            <label for="nom">Nom Utilisateur:</label>
            <input type="text" id="nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>"><br><br>
            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br><br>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>"><br><br>
            <label for="confirmation_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirmation_password" name="confirmation_password" ><br><br>
            <button type="submit" name="creer_compte">Créer un compte</button>
        </form>

        <div class="green-line"></div>

        <form class="form" id="connexion-form" method="post" action="">
            <h2 class="connexion">Connexion</h2>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br><br>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" ><br><br>
            <div class="foot">
                <button type="submit" name="se_connecter">Se connecter</button>
                <a href="reinitialisation_password.php">Mot de passe oublier?</a>
            </div>
        </form>
    </div>
</body>
</html>