<?php
require_once('functions.php');
require_once('header.php');
include('server.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accueil.css">
    <title>profil</title>
</head>

<body class="body">

<?php
$Id = $_SESSION['user']['Id']; // Récupération de l'ID de l'utilisateur connecté
// Connexion à la base de données avec PDO
try {
    $connexion = new PDO('mysql:host=localhost;dbname=Idea', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les informations de l'utilisateur connecté
    $requete = $connexion->prepare("SELECT Id, prenom, nom, date_de_naissance, adresse, email, date_de_creation FROM users WHERE Id = :Id_user");
    $requete->bindParam(':Id_user', $Id); // Liaison du paramètre
    $requete->execute();

    // Vérifie si la requête a renvoyé des résultats
    if ($requete->rowCount() > 0) {
        // Afficher les informations de l'utilisateur
        $row = $requete->fetch(PDO::FETCH_ASSOC);

        echo "<div class='body-content'>";
        echo "<div class='content'>";
        echo "<div class='card-title'>";
        echo "<h3><strong>Informations de l'utilisateur :</strong></h3>";
        echo "<p><strong>Prénom :</strong> " . $row['prenom'] . "</p>";
        echo "<p><strong>Nom :</strong> " . $row['nom'] . "</p>";
        echo "<p><strong>Date de naissance :</strong> " . $row['date_de_naissance'] . "</p>";
        echo "<p><strong>Adresse :</strong> " . $row['adresse'] . "</p>";
        echo "<p><strong>Email :</strong> " . $row['email'] . "</p>";
        echo "<p><strong>Date de création du compte :</strong> " . $row['date_de_creation'] . "</p>"; // Correction de l'affichage
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>Aucune information disponible pour cet utilisateur.</p>";
    }
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
}
?>

</body>

</html>
