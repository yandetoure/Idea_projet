<?php
require_once('functions.php');
require_once('header.php');
include('server.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accueil.css">
    <title>Accueuil</title>
</head>

<body class="body">

<?php
// Assurez-vous que la session est démarrée au début de votre script
session_start();

// Connexion à la base de données avec PDO
try {
    $connexion = new PDO('mysql:host=localhost;dbname=Idea', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les publications de l'utilisateur connecté avec les détails de l'utilisateur, la date de publication, la catégorie et l'idée publiée
    $requete = "SELECT prenom, users.nom AS nom_users, categories.nom AS category, libelle, idees.date_de_creation AS dates FROM users JOIN idees ON users.Id = idees.Id_user JOIN categories ON idees.Id_categorie = categories.Id;"; 
    $resultat = $connexion->prepare($requete);
    $resultat->execute();

    // Vérifie si la requête a renvoyé des résultats
    if ($resultat->rowCount() > 0) {
        // Parcourir les résultats et afficher chaque publication sous forme de carte
        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {

            echo "<div class='body-content'>";
            
            echo "<div class='content'>";

            echo "<div class='card-title'>";

            echo "<h3>Publié par : " . $row['prenom'] .' '. $row['nom_users']."</h3>";

            echo "</div>";
            echo "<h4> Catégorie : " . $row['category'] . "</h4>";

            echo "<div class='card-body'>";

            echo "<h3>" . $row['libelle'] . "</h3>";

            echo "</div>";

            echo "<div class='card-footer'>";
            echo "<h5><strong>Date de publication :</strong> " . $row['dates'] . "</h5>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

        }
    } else {
        echo "<p>Aucune publication disponible pour cet utilisateur.</p>";
    }
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
}
?>


</body>

</html>