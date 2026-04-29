<?php
session_start();
require_once '../../includes/fonctions-factures.php';

// Initialiser facture
if (!isset($_SESSION['facture'])) {
    $_SESSION['facture'] = [];
}

$message = "";

// Traitement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code_barre = $_POST['code_barre'];
    $quantite = intval($_POST['quantite']);

    $produits = chargerProduits();
    $produit_trouve = null;

    foreach ($produits as $p) {
        if ($p['code_barre'] === $code_barre) {
            $produit_trouve = $p;
            break;
        }
    }

    if ($produit_trouve) {

        if ($quantite > $produit_trouve['quantite_stock']) {
            $message = "Stock insuffisant";
        } else {

            $sous_total = $produit_trouve['prix_unitaire_ht'] * $quantite;

            $_SESSION['facture'][] = [
                "code_barre" => $code_barre,
                "nom" => $produit_trouve['nom'],
                "prix_unitaire_ht" => $produit_trouve['prix_unitaire_ht'],
                "quantite" => $quantite,
                "sous_total_ht" => $sous_total
            ];

            $message = "Produit ajouté";
        }

    } else {
        $message = "Produit non trouvé";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Facture</title>
</head>
<body>

<h2>Nouvelle Facture</h2>

<p><?= $message ?></p>

<form method="POST">
    Code barre : <input type="text" name="code_barre" required><br><br>
    Quantité : <input type="number" name="quantite" required><br><br>
    <button type="submit">Ajouter</button>
</form>

<hr>

<h3>Facture en cours</h3>

<table border="1">
<tr>
    <th>Nom</th>
    <th>Prix</th>
    <th>Quantité</th>
    <th>Sous-total</th>
</tr>

<?php foreach ($_SESSION['facture'] as $article): ?>
<tr>
    <td><?= $article['nom'] ?></td>
    <td><?= $article['prix_unitaire_ht'] ?></td>
    <td><?= $article['quantite'] ?></td>
    <td><?= $article['sous_total_ht'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<br>
<a href="calcul.php">Calculer la facture</a>

</body>
</html>