<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="login-form">
        <H2> TP FACTURATION</H2>
            <form action="login.php" method="post">
                <label for="identifiant">Identifiant:</label>
                <input type="text" name="identifiant" id="identifiant" required><br>
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required> <br>
                <input type="submit" value="Se connecter">
            </form>
    
    </div>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    require_once __DIR__ . '/../config/config.php';
    require_once INCLUDES_PATH . 'fonctions-auth.php';
// VERIFICATION DES ENTREES
    $identifiant = htmlspecialchars(trim($_POST['identifiant']));
    $mot_de_passe = htmlspecialchars(trim($_POST['mot_de_passe']));
// AUTHENTIFICATION
    if (authentification(UTILISATEURS_FILE, $identifiant, $mot_de_passe )){
        demarrerSession();
 //       creerSession($utilisateur);
        header("Location: " . BASE_URL);
        exit();

    }
}

?>