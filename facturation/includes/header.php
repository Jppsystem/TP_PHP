<?php 
require_once __DIR__ . '/../config/config.php';
require_once INCLUDES_PATH . 'fonctions-auth.php';
demarrerSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    
</head>
<body>
    <nav class="nav-header">
    <ul class="menu-list">
        <li class="menu-item">
            <a href="<?= BASE_URL ?>" class="menu-link">Accueil</a>
        </li>

        <li class="menu-item dropdown">
            <span class="menu-title">Administration</span>
            <ul class="submenu-list">
                <li class="submenu-item">
                    <a href="<?= ADMIN_PATH_URL . 'ajouter-compte.php' ?>" class="submenu-link">Ajouter un compte</a>
                </li>
                <li class="submenu-item">
                    <a href="<?= ADMIN_PATH_URL . 'gestion-comptes.php' ?>" class="submenu-link">Gestion des comptes</a>
                </li>

            </ul>
        </li>;

        <li class="menu-item dropdown">
            <span class="menu-title">Facturation</span>
            <ul class="submenu-list">
                
                <li class="submenu-item">
                    <a href="<?= FACTURATION_PATH_URL . 'nouvelle-facture.php' ?>" class="submenu-link">Nouvelle facture</a>
                </li>
            </ul>
        </li>

        <li class="menu-item dropdown">
            <span class="menu-title">Produits</span>
            <ul class="submenu-list">
                
                <li class="submenu-item">
                    <a href="<?= PRODUITS_PATH_URL . 'liste.php' ?>" class="submenu-link">Liste</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
    <header>
        <h1><?= APP_NAME ?></h1>
    </header>

</body>
</html>