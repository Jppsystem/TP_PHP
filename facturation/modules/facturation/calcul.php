<?php
session_start();
require_once '../../includes/fonctions-factures.php';

if (empty($_SESSION['facture'])) {
    echo "Aucune facture.";
    exit;
}

$articles = $_SESSION['facture'];

$total_ht = calculTotalHT($articles);
$tva = calculTVA($total_ht);
$total_ttc = calculTTC($total_ht, $tva);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calcul Facture</title>
</head>
<body>

<h2>Résumé</h2>

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

<h3>Total HT : <?= $total_ht ?> CDF</h3>
<h3>TVA : <?= $tva ?> CDF</h3>
<h3>Total TTC : <?= $total_ttc ?> CDF</h3>

<a href="afficher-facture.php">Valider</a>

</body>
</html>