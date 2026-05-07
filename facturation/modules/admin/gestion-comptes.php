
<?php
require_once __DIR__ . '/../../config/config.php'; 
require_once INCLUDES_PATH .'fonctions-auth.php';

$fichier = DATA_PATH . "/utilisateurs.json";
$utilisateurs = chargerUtilisateur();
require_once INCLUDES_PATH . 'header.php';
?>

<body>
    <H2>GESTION DES COMPTE</H2><br>
<table border="1">
    <tr>
        <th>Identifiant</th><th>Nom</th><th>Rôle</th><th>Actif</th><th>Date Creation</th><th>Actions</th>
    </tr>
    <?php foreach ($utilisateurs as $u) { ?>
    <tr>
        <!-- <td></td> -->
        <td><?= $u['identifiant'] ?></td>
        <td><?= $u['nom_complet'] ?></td>
        <td><?= $u['role'] ?></td>
        <td><?= $u['actif'] ? 'Oui' : 'Non' ?></td>
        <td><?= $u['date_creation'] ?></td>
        <td>
            <a href="modifier-compte.php?id=<?= $u['identifiant'] ?>">Modifier</a> |
            <a href="supprimer-compte.php?id=<?= $u['identifiant'] ;?>" onclick="return confirm('Supprimer ce compte ?')">Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>
<br>
<?php require_once INCLUDES_PATH . 'footer.php'; ?>
</body>