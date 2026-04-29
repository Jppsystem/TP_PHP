<?php //session_start(); 
require_once __DIR__ . '/../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    <aside>
        <a href="<?= BASE_URL ?>"><div>
            ACCUEIL
        </div></a>
        <a href="<?= BASE_URL  . '/auth/logout.php' ?>"><div>DECONNEXION</div></a>
        <a href="<?= BASE_URL  . '/modules/admin/ajouter-compte.php' ?>"><div>ADMINISTRATION</div></a>
        <a href="<?= BASE_URL . '/modules/admin/gestion-comptes.php' ?>"><div>GESTION DES COMPTE</div></a>
    </aside>
</body>
</html>