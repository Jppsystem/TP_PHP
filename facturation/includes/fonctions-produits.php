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
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Test Scanner</title>
  <!-- Librairie QuaggaJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
  <!-- Ton script de détection -->
  <script src="assets/js/barcode.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }

    header {
      background: #2c3e50;
      color: #fff;
      padding: 15px;
      text-align: center;
    }

    h1 {
      margin: 0;
      font-size: 24px;
    }

    main {
      max-width: 600px;
      margin: 30px auto;
      padding: 20px;
      text-align: center;
    }

    #camera {
      width: 100%;
      max-width: 500px;
      height: 300px;
      margin: 20px auto;
      border: 3px solid #2c3e50;
      border-radius: 8px;
      background: #000;
    }

    form {
      margin-top: 20px;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      display: none;
    }

    form input, form button {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    form input:focus {
      border-color: #2c3e50;
      outline: none;
    }

    form button {
      background: #2c3e50;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    form button:hover {
      background: #34495e;
    }

    footer {
      margin-top: 30px;
      text-align: center;
      font-size: 12px;
      color: #777;
    }
  </style>
</head>
<body>
  <header>
    <h1>📷 Scanner un produit</h1>
  </header>

  <main>
    <div id="camera"></div>

    <form id="formProduit" action="modules/produits/enregistrer.php" method="POST">
      <input type="text" id="code_barre" name="code_barre" readonly>
      <input type="text" name="nom" placeholder="Nom du produit" required>
      <input type="number" name="prix_unitaire" placeholder="Prix unitaire" required>
      <input type="date" name="date_expiration" required>
      <input type="number" name="quantite_stock" placeholder="Quantité en stock" required>
      <button type="submit">✅ Enregistrer</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2026 - TP Facturation Supermarché</p>
  </footer> //
</body>
</html>

