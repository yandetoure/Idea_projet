<?php
// Connexion à la base de données avec PDO
try {
    $connexion = new PDO("mysql:host=localhost;dbname=Idea", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
    // Récupérer les valeurs du formulaire
    $categorie = $_POST['categorie'];
    $libelle = $_POST['libelle'];

    try {
        // Préparer la requête d'insertion
        $requete = $connexion->prepare("INSERT INTO idees (categorie, libelle) VALUES (:categorie, :libelle)");

        // Binder les valeurs récupérées du formulaire aux paramètres de la requête
        $requete->bindParam(':categorie', $categorie);
        $requete->bindParam(':libelle', $libelle);

        // Exécuter la requête
        $requete->execute();

        echo "L'idée a été enregistrée avec succès.";
    } catch(PDOException $e) {
        echo "Erreur lors de l'enregistrement de l'idée : " . $e->getMessage();
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
<h2>Ajouter une idée</h2>

    <form action="idee.php" method="post" enctype="multipart/form-data" class="form">

        <select name="categorie" id="categorie">
            <?php
            // Connexion à la base de données
            $connexion = new mysqli('localhost', 'root', '', 'Idea');

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("La connexion à la base de données a échoué : " . $connexion->connect_error);
            }

            // Requête pour récupérer les catégories depuis la base de données
            $requete = "SELECT Id, Nom FROM categories";
            $resultat = $connexion->query($requete);

           if ($resultat) {
    if ($resultat->num_rows > 0) {
        // Parcourir les résultats et afficher chaque catégorie comme une option dans le menu déroulant
        while ($row = $resultat->fetch_assoc()) {
            echo "<option value='" . $row['Id'] . "'>" . $row['Nom'] . "</option>";
        }
    } else {
        echo "<option>Aucune catégorie disponible</option>";
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
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