<?php
session_start();
require_once('db.php'); 

// 1. Initialisation des variables de contrôle
// On récupère le continent (?page=...) ou on met 'Afrique' par défaut
$page = isset($_GET['page']) ? $_GET['page'] : 'Afrique';
$offset = isset($_GET['debut']) ? (int)$_GET['debut'] : 0;
$parPage = 20;

// 2. Sécurité et Infos utilisateur
if (!isset($_SESSION['nickname'])) {
    header('Location: connexions.php');
    exit();
}

$stmtUser = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
$stmtUser->execute([$_SESSION['nickname']]);
$userInfos = $stmtUser->fetch();

// 3. Logique de Pagination (Valable pour TOUS les continents)
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM liste_pays WHERE continent = ?");
$stmtCount->execute([$page]);
$totalLignes = $stmtCount->fetchColumn();

$pageActuelle = ($offset / $parPage) + 1;
$totalPages = ceil($totalLignes / $parPage);

// 4. Récupération des données
$stmt = $pdo->prepare("SELECT * FROM liste_pays WHERE continent = ? LIMIT $parPage OFFSET $offset");
$stmt->execute([$page]);
$lignes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 5. Affichage (Design)
$fond = 'UA';
include('design.php'); 
?>

<div style="padding: 20px;">
    <h2>Exploration : <?= htmlspecialchars($page) ?></h2>

<div style="margin-bottom: 15px;">
    <input type="text" id="keywordSearch" onkeyup="filtrerMonEmpire()" 
           placeholder="🔍 Rechercher un pays ou une ville..." 
           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
</div>
    <table border="1" style="width:100%; border-collapse: collapse; background: white;">
        <tr style="background-color: #2c3e50; color: white;">
            <th>Nom</th><th>Description</th><th>Continent</th><th>Illustration</th>
            <?php if ($_SESSION['role'] === 1): ?><th>Mode Admin</th><?php endif; ?>
        </tr>

        <?php if(empty($lignes)): ?>
            <tr><td colspan="5" style="text-align:center; padding:10px;">Aucun pays disponible pour ce continent.</td></tr>
        <?php else: ?>
            <?php foreach ($lignes as $l): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($l['nom']) ?></strong></td>
                    <td><?= htmlspecialchars($l['desciption']) ?></td>
                    <td><?= htmlspecialchars($l['continent']) ?></td>
                    <td><img src="images/<?= htmlspecialchars($l['apercu'] ?? 'default.png') ?>" width="50"></td>
                    <td>
                        <?php if ($_SESSION['role'] === 1): ?>
                            <a href="modifier.php?id=<?= $l['id'] ?>&page=<?= $page ?>">📝</a> | 
                            <a href="supprimer.php?id=<?= $l['id'] ?>&page=<?= $page ?>" onclick="return confirm('Sûr ?')">❌</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <div style="margin-top: 20px; text-align: center;">
        <?php if ($offset > 0): ?>
            <a href="?page=<?= $page ?>&debut=<?= $offset - $parPage ?>" style="text-decoration:none;">⬅️ Précédent</a>
        <?php endif; ?>
        
        <strong> Page <?= $pageActuelle ?> / <?= $totalPages ?> </strong>

        <?php if ($pageActuelle < $totalPages): ?>
            <a href="?page=<?= $page ?>&debut=<?= $offset + $parPage ?>" style="text-decoration:none;">Suivant ➡️</a>
        <?php endif; ?>
    </div>
    
    <br><a href="pagePrincipale.php">🏠 Retour au tableau de bord</a>
</div>
<script>
function filtrerMonEmpire() {
    let input = document.getElementById("keywordSearch").value.toLowerCase();
    let lignes = document.querySelectorAll("table tr:not(:first-child)");

    lignes.forEach(ligne => {
        let texteLigne = ligne.textContent.toLowerCase();
        // Si le texte est trouvé, on affiche la ligne, sinon on la cache
        ligne.style.display = texteLigne.includes(input) ? "" : "none";
    });
}
</script>
<?php include('footer.php'); ?>