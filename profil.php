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
            // Affiche la photo de profil si elle existe
            if(file_exists("uploads/profile_picture.jpg")) {
                echo '<img src="uploads/profile_picture.jpg" alt="Profile Picture">';
            } else {
                echo '<p>No profile picture available</p>';
            }
            ?>
<h3>Ajouter une photo de profil?</h3>
<input type="file" name="file" id="file">
            <button type="submit" name="submit">Changer de photo</button>
<?php
$Id_user = $_SESSION['Id_user'];
// Connexion à la base de données avec PDO
try {
    $connexion = new PDO('mysql:host=localhost;dbname=Idea', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les informations de l'utilisateur connecté
    $requete = $connexion->prepare("SELECT Id, prenom, nom, date_de_naissance, adresse, email, date_de_creation FROM users WHERE Id = :Id_user");
    $requete->bindParam(':Id_user', $Id_user);
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
if (isset($_SESSION['user'])) {
    echo '<a href="logout.php">Déconnecter</a>';
} else {
    // Afficher le bouton de connexion ou rediriger vers la page de connexion si l'utilisateur n'est pas connecté
}
?>

</body>

</html>
