<?php 
// Vérifiez si le formulaire de connexion a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les informations d'identification depuis le formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifiez les informations d'identification dans la base de données

    $requete = $connexion->prepare("SELECT Id, prenom, nom FROM users WHERE email = :email AND mot_de_passe = :mot_de_passe");
    $requete->bindParam(':email', $email);
    $requete->bindParam(':mot_de_passe', $mot_de_passe);
    $requete->execute();

    // Vérifiez si une ligne correspondante est trouvée dans la base de données
    if($requete->rowCount() == 1) {
        // Récupérez les informations de l'utilisateur
        $user = $requete->fetch(PDO::FETCH_ASSOC);

        // Stockez les informations de l'utilisateur dans des variables de session
        $_SESSION['Id_user'] = $user['Id'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];

        // Redirigez l'utilisateur vers la page d'accueil ou toute autre page appropriée
        header("Location: accueil.php");
        exit;
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}

if(isset($_POST["submit"])) {
    $targetDir = "uploads/";

    // Vérifie si le dossier de stockage existe, sinon le crée
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Vérifie si le fichier est une image réelle ou une fausse image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }

    // Vérifie si le fichier existe déjà
    if (file_exists($targetFile)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Vérifie la taille du fichier
    if ($_FILES["file"]["size"] > 500000) {
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Autorise certains formats de fichiers
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifie si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    // Si tout est correct, télécharge le fichier
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            echo "Le fichier ". htmlspecialchars( basename( $_FILES["file"]["name"])). " a été téléchargé.";
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
}
?>

?>