<?php
require_once "server.php";
// Démarrer la session

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {


	// Récupérer les données du formulaire
	$email = $_POST['email'];
	$mot_de_passe = $_POST['mot_de_passe'];

	// Requête pour vérifier l'existence de l'email et du mot de passe
	$sql = "SELECT * FROM users WHERE email = :email AND mot_de_passe =:mot_de_passe";
	$stmt = $connexion->prepare($sql);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':mot_de_passe', $mot_de_passe);

	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user) {
		// Vérifier le mot de passe


		session_start();

		// Authentification réussie, rediriger vers la page d'accueil
		$_SESSION['user'] = $user; // Stocker le prénom dans la session
		header("Location: accueil.php");
		exit();
	}
} else {
	$errorMessage = "Mot de passe incorrect";
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
			<h2>Connexion</h2>
			<?php if (isset($errorMessage)) : ?>
				<div><?php echo $errorMessage; ?></div>
			<?php endif; ?>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
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