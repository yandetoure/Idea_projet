<?php
// Démarrer la session si ce n'est pas déjà fait
session_start();

// Détruire toutes les données de session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion ou toute autre page après la déconnexion
header("Location: login.php");
exit();
?>
