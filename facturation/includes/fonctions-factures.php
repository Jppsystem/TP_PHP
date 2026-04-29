<?php
require_once __DIR__ . '/fonctions-json.php';

// Charger factures
function chargerFactures() {
    return lireJSON(__DIR__ . '/../data/factures.json');
}

// Sauvegarder facture
function sauvegarderFacture($facture) {
    $factures = chargerFactures();
    $factures[] = $facture;

    ecrireJSON(__DIR__ . '/../data/factures.json', $factures);
}

// Générer ID
function genererIDFacture() {
    return "FAC-" . date('Ymd-His');
}

// Calculs
function calculTotalHT($articles) {
    return array_sum(array_column($articles, 'sous_total_ht'));
}

function calculTVA($total_ht) {
    return $total_ht * 0.18;
}

function calculTTC($total_ht, $tva) {
    return $total_ht + $tva;
}

// Charger produits
function chargerProduits() {
    return lireJSON(__DIR__ . '/../data/produits.json');
}

// Mise à jour stock
function mettreAJourStock($articles) {
    $produits = chargerProduits();

    foreach ($articles as $article) {
        foreach ($produits as &$p) {
            if ($p['code_barre'] === $article['code_barre']) {
                $p['quantite_stock'] -= $article['quantite'];
            }
        }
    }

    ecrireJSON(__DIR__ . '/../data/produits.json', $produits);
}