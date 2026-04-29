<?php
session_start();
//Charger Utilisateur
function chargerUtilisateur($fichier){
    $json_data = file_get_contents(DATA_PATH . "utilisateurs.json");
    return json_decode($json_data, true);   
}
//RECHERCHE D'UN UTILISATEUR
function trouverUtilisateur($identifiant, $utilisateurs){
    foreach($utilisateurs as $utilisateur){
        if ($utilisateur['identifiant'] === $identifiant){
            return $utilisateur;
        }
    }
    return false;
}
//SAUVEGARDER UTILISATEURS

function sauvegarderUtilisateurs( $fichier,  $utilisateurs) {
    // 1. Convertir le tableau PHP en JSON
    $json = json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // 2. Vérifier si la conversion a réussi
    if ($json === false) {
        throw new RuntimeException("Erreur lors de la conversion en JSON : " . json_last_error_msg());
    }

    // 3. Écrire le JSON dans le fichier
    $resultat = file_put_contents($fichier, $json);

    // 4. Vérifier si l’écriture a réussi
    if ($resultat === false) {
        throw new RuntimeException("Impossible d'écrire dans le fichier $fichier");
    }
}


//VERIFICATION MOT DE PASSE NON HACHE
function verifierMotDePasse($motDePasseSaisi, $motDePasseStocke){
    return ($motDePasseSaisi === $motDePasseStocke);
}

//VERIFICATION MOT DE PASSE HACHE
function verifierMotDePasseHash($motDePasseSaisi, $motDePasseStocke){
    return password_verify($motDePasseSaisi, $motDePasseStocke);
}

//AUTHENTIFIER
function authentification($fichier, $identifiant, $motDePasseSaisi){
    $utilisateurs = chargerUtilisateur($fichier);
    $utilisateur = trouverUtilisateur($identifiant, $utilisateurs); 
    if ($utilisateur && verifierMotDePasse($motDePasseSaisi, $utilisateur['mot_de_passe']) ){
       // definirSession($identifiant);
        return true;
    }
    return false;
}
//

//DEFINITION DE SESSION
function definirSession($identifiant){
    $_SESSION['user'] = $identifiant;
}
?>