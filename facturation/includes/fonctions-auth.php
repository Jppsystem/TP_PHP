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