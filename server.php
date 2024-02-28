<?php 

    $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "Idea";

    //  $conn = new PDO("mysql:host=$servername;dbname=$dbname;",$username, $password);

    //  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
try {
  //Connexion à la base de données avec PDO
    // $connexion = new PDO($serveurname, $utilisateur, $mot_de_passe);
    // echo 'ok';
     $connexion = new PDO("mysql:host=$servername;dbname=$dbname;",$username, $password);

    // Configuration pour afficher les erreurs PDO
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connexion OK";
    
    // Requête SQL pour sélectionner les entrepreneurs
    $requete = "SELECT id, nom FROM categories";
    $resultat = $connexion->query($requete);

} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

// Fermeture de la connexion à la base de données
//$connexion = null; 
?>