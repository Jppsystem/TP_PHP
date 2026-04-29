<?php 

session_start(); 
require_once  __DIR__ . '/../../config/config.php';
require_once INCLUDES_PATH . 'header.php';

// //VERIFICATION DE LA SESSION
//     if (!isset($_SESSION['user'])){
//         header("Location: LOGIN_PATH");
//         exit();
//     }



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
    <?php require_once INCLUDES_PATH . 'header.php'; ?>
    <!-- // FORMULAIRE D'AJOUT D'UTILISATEUR -->
    <div class="ajout_utilisateur">
        <h2>Formulaire d'ajout d'utilisateur</h2>

    <form action="traitement_utilisateur.php" method="POST">
        <label for="identifiant">Identifiant :</label>
        <input type="text" id="identifiant" name="identifiant" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>

        <label for="nom_complet">Nom complet :</label>
        <input type="text" id="nom_complet" name="nom_complet" required><br>

        <label for="role">Rôle :</label>
        <select id="role" name="role" required>
            <option value="manager"></option>
            <option value="admin">Admin</option>
            <option value="caissier">Caissier</option>

        </select><br>

        <label for="date_creation">Date de création :</label>
        <input type="date" id="date_creation" name="date_creation" value="<?php echo date('Y-m-d'); ?>" required><br>

        <label for="actif">Actif :</label>
        <select id="actif" name="actif" required>
            <option value="true">Oui</option>
            <option value="false">Non</option>
        </select>
        <br>
        <button type="submit">Ajouter l'utilisateur</button>
    </form>
    </div>
</body>
</html>