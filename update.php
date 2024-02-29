<?php
// Inclusion des fichiers nécessaires et démarrage de la session
require_once('functions.php');
require_once('header.php');
include('server.php');
session_start();

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $id_idee = $_POST['id_idee'];
    $categorie = $_POST['category'];
    $libelle = $_POST['libelle'];

    // Requête SQL pour mettre à jour la catégorie de l'idée
    $requete = "UPDATE idees SET Id_categorie = :nouvelle_categorie WHERE id = :id_idee";

    try {
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':id_idee', $id_idee);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':libelle', $libelle);
        $stmt->execute();

        // Redirection vers la page précédente ou une autre page
        header("Location: mes_idees.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
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
