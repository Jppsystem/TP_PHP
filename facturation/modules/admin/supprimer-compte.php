<?php
require_once __DIR__ . '/../../config/config.php'; 
require_once INCLUDES_PATH .'fonctions-auth.php';

$fichier = DATA_PATH . "utilisateurs.json";
$utilisateurs = chargerUtilisateur();

if (isset($_GET['id'])) {
    $identifiant = filter_input(INPUT_GET, 'id', FILTER_UNSAFE_RAW);
    $utilisateurs = array_filter($utilisateurs, fn($u) => $u['identifiant'] !== $identifiant);
    sauvegarderUtilisateurs($fichier, array_values($utilisateurs));
    header("Location: " . BASE_URL . "/modules/admin/gestion-comptes.php");
    exit;
}

