<?php
require('server.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $requete = $connexion->prepare("INSERT INTO users(prenom, nom, date_de_naissance, adresse, email, mot_de_passe) VALUES(:prenom, :nom, :date_de_naissance, :adresse, :email, :mot_de_passe)");
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':date_de_naissance', $date_de_naissance);
    $requete->bindParam(':adresse', $adresse);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':mot_de_passe', $mot_de_passe);
    $requete->execute();
    echo 'Inscription réussie';
} else {
    echo 'Problème de connexion';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
    </head>

    <body class="body">
	<div class="body-content">
        <div class="card">
            <h2>Inscription</h2>
            <form action="inscription.php" method="post" class="form">

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required><br>

                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required><br>

                <label for="date_de_naissance">Date de naissance :</label>
                <input type="text" id="date_de_naissance" name="date_de_naissance" required><br>

                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required><br>

                <label for="email">Email :</label>
                <input type="Email" id="email" name="email" required><br>

                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>


                <button type="submit" name="submit">S'inscrire</button>
            </form>
        </div>
    </div>

    </body>

    </html>

</body>

</html>