<?php
require_once(__DIR__ . "/../../config/config.php"); // on charge les constantes

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
$code = $data["code_barre"] ?? null;

// On utilise la constante PRODUITS_FILE
$produits = json_decode(file_get_contents(PRODUITS_FILE), true) ?? [];

$found = null;
foreach ($produits as $p) {
    if ($p["code_barre"] === $code) {
        $found = $p;
        break;
    }
}

if ($found) {
    echo json_encode(["existe" => true] + $found);
} else {
    echo json_encode(["existe" => false]);
}//
?>
