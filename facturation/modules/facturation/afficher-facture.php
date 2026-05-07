<?php
require_once __DIR__ . '/../../config/config.php';
require_once INCLUDES_PATH . 'fonctions-auth.php';
demarrerSession();
require_once '../../includes/fonctions-factures.php';
require_once '../../includes/fonctions-produits.php';
if (empty($_SESSION['facture'])) {
    echo "Aucune facture.";
    exit;
}

$articles = $_SESSION['facture'];

$total_ht = calculTotalHT($articles);
$tva = calculTVA($total_ht);
$total_ttc = calculTTC($total_ht, $tva);

$id = genererIDFacture();
$date = date('Y-m-d');
$heure = date('H:i:s');

$caissier = $_SESSION['user']['identifiant'] ?? "inconnu";

$facture = [
    "id_facture" => $id,
    "date" => $date,
    "heure" => $heure,
    "caissier" => $caissier,
    "articles" => $articles,
    "total_ht" => $total_ht,
    "tva" => $tva,
    "total_ttc" => $total_ttc
];

// Sauvegarde + mise à jour stock
sauvegarderFacture($facture);
mettreAJourStock($articles);

// reset
unset($_SESSION['facture']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Facture finale</title>
</head>
<body>

<h2>Facture validée</h2>

<p>ID : <?= $id ?></p>

<table border="1">
<tr>
    <th>Nom</th>
    <th>Prix</th>
    <th>Quantité</th>
    <th>Sous-total</th>
</tr>

<?php foreach ($articles as $a): ?>
<tr>
    <td><?= $a['nom'] ?></td>
    <td><?= $a['prix_unitaire_ht'] ?></td>
    <td><?= $a['quantite'] ?></td>
    <td><?= $a['sous_total_ht'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<h3>Total HT : <?= $total_ht ?></h3>
<h3>TVA : <?= $tva ?></h3>
<h3>Total TTC : <?= $total_ttc ?></h3>

<a href="nouvelle-facture.php">Nouvelle facture</a>


</body>
</html>