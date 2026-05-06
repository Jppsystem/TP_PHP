<?php session_start(); ?>
<?php require_once __DIR__ . '/config/config.php';
require_once INCLUDES_PATH . 'header.php';
?>
<<<<<<< HEAD
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
