<?php
require_once("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code_barre = $_POST["code_barre"] ?? "";
    $nom = $_POST["nom"] ?? "";
    $prix_unitaire = $_POST["prix_unitaire"] ?? "";
    $date_expiration = $_POST["date_expiration"] ?? "";
    $quantite_stock = $_POST["quantite_stock"] ?? "";
    $date_enregistrement = date("Y-m-d");

    $erreurs = [];

    // ✅ Vérification prix : entier positif
    if (!ctype_digit($prix_unitaire) || intval($prix_unitaire) <= 0) {
        $erreurs[] = "Le prix doit être un entier positif.";
    }

    // ✅ Vérification quantité : entier positif
    if (!ctype_digit($quantite_stock) || intval($quantite_stock) <= 0) {
        $erreurs[] = "La quantité doit être un entier positif.";
    }

    if (!empty($erreurs)) {
        // Affiche les erreurs mais garde le formulaire
        foreach ($erreurs as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
        include("../includes/form_produit.php"); // formulaire réaffiché
        exit;
    }

    // ✅ Si pas d’erreurs → ajout dans produits.json
   // Si pas d’erreurs -> ajout dans produits.json
$produits = json_decode(file_get_contents(PRODUITS_FILE), true) ?? [];
$produits[] = [
    "code_barre" => $code_barre,
    "nom" => $nom,
    "prix_unitaire" => intval($prix_unitaire),
    "date_expiration" => $date_expiration,
    "quantite_stock" => intval($quantite_stock),
    "date_enregistrement" => $date_enregistrement
];
file_put_contents(PRODUITS_FILE, json_encode($produits, JSON_PRETTY_PRINT));

echo "<p style='color:green;'>Produit enregistré avec succès !</p>";

}
?>

