<?php

function lireJSON($chemin) {
    if (!file_exists($chemin)) return [];
    return json_decode(file_get_contents($chemin), true) ?? [];
}

function ecrireJSON($chemin, $data) {
    file_put_contents($chemin, json_encode($data, JSON_PRETTY_PRINT));
}