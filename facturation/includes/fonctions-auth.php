<?php
//Charger Utilisateur
function chargerUtilisateur(){
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



//TRANSFORMATION DU TABLEAU EN JSON
function tableauToJson($tableau){
    return json_encode($tableau, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
//ECRIRE DANS LE FICHIER JSON
function ecritureJson($fichier, $data){
    return file_put_contents($fichier, $data);
}
//SAUVEGARDER UTILISATEURS

function sauvegarderUtilisateurs( $fichier,  $utilisateurs) {
    // 1. Convertir le tableau PHP en JSON
    $json = tableauToJson($utilisateurs);

    // 2. Vérifier si la conversion a réussi
    if ($json === false) {
        echo "<p style = 'color:red' >Erreur lors de la conversion en JSON : " . json_last_error_msg(). "</p>";
    }

    // 3. Écrire le JSON dans le fichier
    $resultat = ecritureJson($fichier, $json);

    // 4. Vérifier si l’écriture a réussi
    if ($resultat === false) {
       echo "<p style = 'color:red' >Impossible d'écrire dans le fichier $fichier</p>";
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
    if ($utilisateur && verifierMotDePasseHash($motDePasseSaisi, $utilisateur['mot_de_passe']) ){
       // definirSession($identifiant);
       creerSession($utilisateur);
        return true ;

    }
    return false;
}
//

//DEFINITION DE SESSION
// function definirSession($utilisateur){
//     $_SESSION['user'] = $utilisateur['identifiant'];
//     $_SESSION['role'] = $utilisateur['role'];
// }
// VÉRIFICATION SI L'UTILISATEUR EST CONNECTÉ
function estConnecte(){
    return isset($_SESSION['user']);
}
// VÉRIFICATION SI L'UTILISATEUR EST ADMIN
// function estAdmin(){
//     return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
// }
// VÉRIFICATION SI L'UTILISATEUR EST MANAGER
// function estManager(){
//     return isset($_SESSION['role']) && $_SESSION['role'] === 'manager';
// }
// VÉRIFICATION SI L'UTILISATEUR EST CAISSIER
// function estCaissier(){
//     return isset($_SESSION['role']) && $_SESSION['role'] === 'caissier';
// }
//DECONNEXION
function deconnecter(){
    session_destroy();
}
//REDIRECTION
function rediriger($url){
    header("Location: $url");
    exit();
}
// VÉRIFICATION SI L'UTILISATEUR EXISTE 
function utilisateurExiste($identifiant, $utilisateurs){
    if( trouverUtilisateur($identifiant, $utilisateurs) !== false){       
        return true;
    }
    
}
//TRANSFORMATION DU FORMULAIRE EN UTILISATEUR
function formulaireToUtilisateur($data){ 
    return [
        'identifiant' => $data['identifiant'],
        'mot_de_passe' => password_hash($data['mot_de_passe'], PASSWORD_DEFAULT),
        'nom_complet' => $data['nom_complet'],
        'role' => $data['role'],
        'actif' => $data['actif'] === 'true',
        'date_creation' => $data['date_creation']
    ];
}

// SESSIONS
//DEMARRER LA SESSION
function demarrerSession(){
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }
}

// Creer la session
function creerSession($utilisateur){
    demarrerSession();
    $_SESSION['user'] = $utilisateur['identifiant'];
    $_SESSION['nom_complet'] = $utilisateur['nom_complet'];
    $_SESSION['role'] = $utilisateur['role'];
}
// estAdmin
function estAdmin(){
    demarrerSession();
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
} 
// estManager
function estManager(){
    demarrerSession();
    return isset($_SESSION['role']) && $_SESSION['role'] === 'manager';
    
} 
//Est Caissier
function estCaissier(){
    demarrerSession();
     return isset($_SESSION['role']) && $_SESSION['role'] === 'caissier';
}
//REDIRECTION PAGE CONNEXION
function redirectionLogin(){
    if (!isset($_SESSION['user'])){
        header("Location: " . BASE_URL . "/auth/login.php");
        exit();
    }
}
 ?>