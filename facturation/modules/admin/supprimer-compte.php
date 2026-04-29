<?php
require_once __DIR__ . '/../../config/config.php'; 
require_once INCLUDES_PATH .'fonctions-auth.php';

$fichier = "../data/utilisateurs.json";
$utilisateurs = chargerUtilisateur($fichier);

if (isset($_GET['identifiant'])) {
    $identifiant = $_GET['identifiant'];
    $utilisateurs = array_filter($utilisateurs, fn($u) => $u['identifiant'] !== $identifiant);
    sauvegarderUtilisateurs($fichier, array_values($utilisateurs));
    echo "<p>Compte supprimé avec succès.</p>";
    echo "<a href='gestion-comptes.php'>Retour à la gestion</a>";
}

