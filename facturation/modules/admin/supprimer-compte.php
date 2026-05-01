<?php
require_once __DIR__ . '/../../config/config.php'; 
require_once INCLUDES_PATH .'fonctions-auth.php';

$fichier = DATA_PATH . "utilisateurs.json";
$utilisateurs = chargerUtilisateur($fichier);

if (isset($_GET['identifiant'])) {
    $identifiant = $_GET['identifiant'];
    $utilisateurs = array_filter($utilisateurs, fn($u) => $u['identifiant'] !== $identifiant);
    sauvegarderUtilisateurs($fichier, array_values($utilisateurs));
    header("Location: " . ADMIN_PATH . "gestion-comptes.php");
    exit;
}

