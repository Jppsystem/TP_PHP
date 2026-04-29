<?php
// Nom et paramètres globaux
define('APP_NAME', 'TP Facturation');
define ('APP_LANG', 'fr');
date_default_timezone_set('Africa/Kinshasa');

// CHEMINS PRINCIPAUX
define('BASE_PATH',__DIR__.'/../');
define('BASE_URL','http://TP_PHP.test/facturation');

// CHEMINS DES DOSSIERS
define('ASSETS_PATH', BASE_URL . 'assets/');
define('CSS_PATH', ASSETS_PATH .'css/');
define('JS_PATH', ASSETS_PATH .'js/');
define('MODULES_PATH', BASE_PATH .'modules/');
define('INCLUDES_PATH', BASE_PATH .'includes/');
define('AUTH_PATH', BASE_PATH .'auth/');
define('RAPPORTS_PATH', BASE_PATH .'rapports/');
define('DATA_PATH', BASE_PATH .'data/');
define('PRODUITS_PATH', MODULES_PATH .'produits/');
define('FACTURATION_PATH', MODULES_PATH .'facturation/');
define('ADMIN_PATH', MODULES_PATH .'admin/');
define('CONFIG_PATH', BASE_PATH .'config/');
// CHEMINS DES FICHIERS
define('LOGIN_PATH', AUTH_PATH .'login.php');
define('PRODUITS_FILE', DATA_PATH .'produits.json');
define('UTILISATEURS_FILE', DATA_PATH .'utilisateurs.json');
define('FACTURES_FILE', DATA_PATH .'factures.json');

?>