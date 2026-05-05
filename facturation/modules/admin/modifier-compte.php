<?php
session_start();

require_once __DIR__ . '/../../config/config.php';
require_once INCLUDES_PATH . 'header.php';
require_once INCLUDES_PATH . 'fonctions-auth.php';

// TROUVER L'UTILISATEUR A MODIFIER
if (isset($_GET['id'])) {
    $identifiant = filter_input(INPUT_GET, 'id', FILTER_UNSAFE_RAW);
    $utilisateurs = chargerUtilisateur();
    $utilisateur = trouverUtilisateur($identifiant, $utilisateurs);
    if (!$utilisateur) {
        echo "<p style='color:red'>L'utilisateur $identifiant n'existe pas</p>";
        exit; // éviter d'afficher le formulaire avec $utilisateur null
    }
}

// EXECUTION DE LA MODIFICATION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateurModifie = formulaireToUtilisateur($_POST);
    $utilisateurs = chargerUtilisateur();

    // Remplacer l'utilisateur existant par la version modifiée
    foreach ($utilisateurs as &$u) {
        if ($u['identifiant'] === $utilisateurModifie['identifiant']) {
            $u = $utilisateurModifie;
            break;
        }
    }

    sauvegarderUtilisateurs(DATA_PATH . 'utilisateurs.json', $utilisateurs);

    header("Location: " . BASE_URL . "/modules/admin/gestion-comptes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
    <header>
        <?php require_once INCLUDES_PATH . 'header.php'; ?>
    </header>

    <div class="ajout_utilisateur">
        <h2>Formulaire de modification d'utilisateur</h2>

        <form action="modifier-compte.php" method="POST">
            <label for="identifiant">Identifiant :</label>
            <input type="text" id="identifiant" name="identifiant" readonly 
                   value="<?= htmlspecialchars($utilisateur['identifiant']); ?>" required><br>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" 
                   placeholder="Veuillez saisir un nouveau mot de passe"><br>

            <label for="nom_complet">Nom complet :</label>
            <input type="text" id="nom_complet" name="nom_complet" 
                   value="<?= htmlspecialchars($utilisateur['nom_complet']); ?>" required><br>

            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="<?= htmlspecialchars($utilisateur['role']); ?>">
                    <?= htmlspecialchars($utilisateur['role']); ?>
                </option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
                <option value="caissier">Caissier</option>
            </select><br>

            <label for="date_creation">Date de création :</label>
            <input type="date" id="date_creation" name="date_creation" 
                   value="<?= htmlspecialchars($utilisateur['date_creation']); ?>" required><br>

            <label for="actif">Actif :</label>
            <select id="actif" name="actif" required>
                <option value="">Veuillez choisir l'état</option>
                <option value="true" <?= $utilisateur['actif'] === 'true' ? 'selected' : ''; ?>>Oui</option>
                <option value="false" <?= $utilisateur['actif'] === 'false' ? 'selected' : ''; ?>>Non</option>
            </select><br>

            <button type="submit">Modifier l'utilisateur</button>
        </form>
    </div>
</body>
</html>
