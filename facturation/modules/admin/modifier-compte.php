<?php
session_start();

require_once  __DIR__ . '/../../config/config.php';
require_once INCLUDES_PATH .'header.php';
require_once INCLUDES_PATH .'fonctions-auth.php';
//TROUVER L'UTILISATEUR A MODIFIER
if (isset($_GET['id'])){
    $identifiant = $_GET['id'];
    $utilisateurs = chargerUtilisateur();
    $utilisateur = trouverUtilisateur($identifiant, $utilisateurs);
    if (!isset($utilisateur)){
        echo "<p style = 'color:red'>L'utilisateur $identifiant n'existe pas</p> ";
    }
}
//EXECUTION DE LA MODIFICATION
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $utilisateurModifie = formulaireToUtilisateur($_POST);
    $utilisateurs = chargerUtilisateur();
   // $utilisateur = trouverUtilisateur($utilisateurModifie['identifiant'], $utilisateurs);
    $utilisateurs = array_filter($utilisateurs, fn($u) => $u['identifiant'] !== $utilisateurModifie['identifiant']);
    // $json = tableauToJson($utilisateurs);
    sauvegarderUtilisateurs(DATA_PATH . 'utilisateurs.json', $utilisateurs);

    header("Location : " . ADMIN_PATH ."gestion-compte");
exit;
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
    <!-- // AJOUT DU HEADER -->
     <header>
        <?php require_once INCLUDES_PATH . 'header.php'; 
        //echo "<h2>Bienvenue, " . htmlspecialchars($_SESSION['user']['nom_complet']) . " (" . htmlspecialchars($_SESSION['user']['role']) . ")</h2>";
        ?>
     </header>
    <p></p>
    <!-- // FORMULAIRE DE MODIFICATION D'UTILISATEUR -->
    <div class="ajout_utilisateur">
        <h2>Formulaire de modification d'utilisateur</h2>

    <form action="modifier-compte.php" method="POST">
        <label for="identifiant">Identifiant :</label>
        <input type="text" id="identifiant" name="identifiant" readonly value="<?= $utilisateur['identifiant'] ;?> " required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Veuillez Saisir un nouveau mot de passe"><br>

        <label for="nom_complet">Nom complet :</label>
        <input type="text" id="nom_complet" name="nom_complet" value="<?= $utilisateur['nom_complet'];?> "  required><br>

        <label for="role">Rôle :</label>
        <select id="role" name="role" required>
            <option value="<?= $utilisateur['role'] ; ?> "><?= $utilisateur['role'] ; ?> </option>
            <option value="manager">Manager</option>
            <option value="admin">Admin</option>
            <option value="caissier">Caissier</option>

        </select><br>

        <label for="date_creation">Date de création :</label>
        <input type="date" id="date_creation" name="date_creation" value="<?php echo date('Y-m-d'); ?>" required><br>

        <label for="actif">Actif :</label>
        <select id="actif" name="actif" required>
            <option value="">Veuillez choisir l'Etat </option>
            <option value="true">Oui</option>
            <option value="false">Non</option>
        </select>
        <br>
        <button type="submit">Modifier l'utilisateur</button>
    </form>
    </div>
</body>
</html>
