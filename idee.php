<?php
require_once('header.php');
require('server.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $libelle = $_POST['libelle'];
    $statut = 0;
    // Récupérer l'ID de l'utilisateur de la session
    $Id_user = $_SESSION['user']['Id'];
    $categorie = $_POST['categorie']; // Assurez-vous que le nom du champ correspond au nom dans le formulaire
    $date_de_creation = date("Y-m-d H:i:s");

    try {
        $requete = $connexion->prepare("INSERT INTO idees (libelle, statut, date_de_creation,  Id_user, Id_categorie) VALUES (:libelle, :statut, :date_de_creation, :Id_user, :Id_categorie)");
        $requete->bindParam(':libelle', $libelle);
        $requete->bindParam(':statut', $statut);
        $requete->bindParam(':date_de_creation', $date_de_creation);
        $requete->bindParam(':Id_user', $Id_user);
        $requete->bindParam(':Id_categorie', $categorie); // Utilisation de la variable $categorie plutôt que $Id_categorie
        $requete->execute();
        echo "<h4> Idée enregistrée avec succès</h4> ";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion de l'enregistrement : " . $e->getMessage();
    }
} else {
    echo 'Problème de connexion';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="idee.css">
    <title>Idées</title>
</head>
<body class="body">

<div class="body-content">
    <div class="card">


        <form action="idee.php" method="post" enctype="multipart/form-data" class="form">

        <h2>Ajouter une nouvelle idée</h2>

            <select name="categorie" id="categorie">
                <?php

                    $requete = "SELECT Id, Nom FROM categories";
                    $resultat = $connexion->query($requete);

                    if ($resultat->rowCount() > 0) {
                        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['Id'] . "'>" . $row['Nom'] . "</option>";
                        }
                    } else {
                        echo "<option>Aucune catégorie disponible</option>";
                    }
                ?>
            </select>
            <br>

            <label for="libelle">Votre idée :</label>
            <input type="text" id="libelle" name="libelle" required><br>

            <button type="submit" name="submit">Enregistrer</button>
        </form>
    </div>
</div>
</body>
</html>
