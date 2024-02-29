<?php
require_once "server.php";
// Démarrer la session
session_start();

// Vérifiez si l'utilisateur est déjà connecté, redirigez-le vers la page d'accueil s'il l'est
if(isset($_SESSION['Id'])) {
    header("Location: accueil.php");
    exit;
}

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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="connexion.css">
	<title>Connexion</title>
</head>

<body class="body">
	<div class="body-content">
		<div class="card">
			<?php if (isset($errorMessage)) : ?>
				<div><?php echo $errorMessage; ?></div>
			<?php endif; ?>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
            <h2>Connexion</h2>
				<label for="email">Email :</label><br>
				<input type="email" id="email" name="email" required><br>
				<label for="password">Mot de passe :</label><br>
				<input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
				<button type="submit">Se connecter</button>
			</form>
		</div>
	</div>
</body>

</html>