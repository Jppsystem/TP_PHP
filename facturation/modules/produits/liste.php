<?php
require_once("../../config/config.php");
require_once INCLUDES_PATH . 'fonctions-auth.php';

demarrerSession();

$produits = json_decode(file_get_contents(PRODUITS_FILE), true) ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des produits</title>
  <style>
    table { border-collapse: collapse; width: 80%; margin: 20px auto; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    th { background: #2c3e50; color: #fff; }
    tr:nth-child(even) { background: #f4f6f9; }
  </style>
</head>
<body>
  <h1 style="text-align:center;">📦 Liste des produits</h1>
  <table>
    <tr>
      <th>Code-barre</th>
      <th>Nom</th>
      <th>Prix</th>
      <th>Date expiration</th>
      <th>Quantité</th>
      <th>Date enregistrement</th>
    </tr>
    <?php foreach ($produits as $p): ?>
    <tr>
      <td><?= htmlspecialchars($p["code_barre"]) ?></td>
      <td><?= htmlspecialchars($p["nom"]) ?></td>
      <td><?= htmlspecialchars($p["prix_unitaire"]) ?></td>
      <td><?= htmlspecialchars($p["date_expiration"]) ?></td>
      <td><?= htmlspecialchars($p["quantite_stock"]) ?></td>
      <td><?= htmlspecialchars($p["date_enregistrement"]) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>

  <?php require_once INCLUDES_PATH . 'footer.php'; ?>
</body>
</html>
