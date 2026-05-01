<?php
require_once("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produits = json_decode(file_get_contents(PRODUITS_FILE), true) ?? [];

    $produits[] = [
        "code_barre" => $_POST["code_barre"],
        "nom" => $_POST["nom"],
        "prix_unitaire" => floatval($_POST["prix_unitaire"]),
        "date_expiration" => $_POST["date_expiration"],
        "quantite_stock" => intval($_POST["quantite_stock"]),
        "date_enregistrement" => date("Y-m-d")
    ];

    file_put_contents(PRODUITS_FILE, json_encode($produits, JSON_PRETTY_PRINT));
    echo "<p style='color:green;'>Produit enregistré avec succès !</p>";
}
?>
