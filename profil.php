<?php  require_once(__DIR__. '/functions.php');
include ('server.php' )
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body class="body">

<div class="card">
<h2>Inscription</h2>
    <form action="inscription.php" method="post" enctype="multipart/form-data" class="form">

    <label for="Prenom">Prénom :</label>
        <input type="text" id="Prenom" name="Prenom" required><br>

        <label for="Nom">Nom :</label>
        <input type="text" id="Nom" name="Nom" required><br>

        <label for="Adresse">Adresse :</label>
        <input type="text" id="Adresse" name="Adresse" required><br>

        <label for="Date_de_naissance">Date de naissance :</label>
        <input type="text" id="Date_de_naissance" name="Date_de_naissance" required><br>

        <label for="Password">Mot de passe :</label>
        <input type="Password" id="Password" name="Password" required><br>

        <label for="Email">Email :</label>
        <input type="Email" id="Email" name="Email" required><br>
        
       
        <button type="submit" name="submit">S'inscrire</button>
    </form>
</div>
   
</body>
</html>

</body>
</html>