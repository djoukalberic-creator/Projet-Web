<?php
session_start();
require_once('db.php'); 
$stmtUser = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
$stmtUser->execute([$_SESSION['nickname']]);
$userInfos = $stmtUser->fetch();

$email = $userInfos['email'] ?? 'Non renseigné';
if (!isset($_SESSION['avatar']) || empty($_SESSION['avatar'])) {
    $_SESSION['avatar'] = $userInfos['avatar'];
}

// Sécurité : Si pas connecté, retour au login
if (!isset($_SESSION['nickname'])) {
    header('Location: connexions.php');
    exit();
}

// 1. On importe le "haut" de la page (le design)
$fond = 'UA';
include('design.php'); 
?>
<?php
// Dans pagePrincipale.php, après avoir récupéré $userInfos
$ma_recommandation = $pdo->prepare("SELECT * FROM liste_pays WHERE tags LIKE ? AND tags LIKE ? LIMIT 1");
$ma_recommandation->execute(["%".$userInfos['pref_climat']."%", "%".$userInfos['pref_activite']."%"]);
$top_pays = $ma_recommandation->fetch();

if ($top_pays): ?>
    <div style="background: #e3f2fd; padding: 15px; border-radius: 10px; margin: 20px;">
        <strong>💡 Spécialement pour vous, <?= htmlspecialchars($_SESSION['nickname']) ?> :</strong> 
        Comme vous aimez le <?= $userInfos['pref_climat'] ?>, nous vous suggérons de visiter 
        <a href="liste_pays.php?page=<?= $top_pays['continent'] ?>"><?= $top_pays['nom'] ?></a> !
    </div>
<?php endif; ?>
<p>Mise à jour : <?= date('d/m/Y H:i') ?></p>
<div style="display: flex; min-height: 100vh;">
    
    <nav style="width: 250px; background-color: #2c3e50; color: white; padding: 20px;">
        <ul style="list-style: none; padding: 0;">
            <div class="container" style="position: relative;">
<div style="position: absolute; left: 20px; top: 20px; display: flex; align-items: center; gap: 10px;">
    <a href="mon_profil.php" style="text-decoration: none;">
        <div style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #E65100; overflow: hidden; background: #fff;">
            <img src="<?= htmlspecialchars($_SESSION['avatar'] ?? 'images/avatar_default.jpg') ?>" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        </a>
        <div style="text-align: left; line-height: 1.2;">
            <span style="font-weight: bold; color: #333; font-size: 0.8em;"><?= htmlspecialchars($_SESSION['nickname']) ?></span>
        </div>
    </div><br>
             <hr>
            <li style="margin: 15px 0;"><a href="?page=historique" style="color: black; text-decoration: none;">📜 Historique</a></li>
            <?php if ($_SESSION['role'] === 1): ?>
    <a href="traitement_ajout.php" style="display: block; padding: 10px; color: #f1c40f; font-weight: bold; text-decoration: none; border-left: 4px solid #f1c40f; margin-top: 10px;">
        📊 ajouter un pays
    </a>
<?php endif; ?>
        </ul>
        <div style="margin-top: 50px;">
             <a href="connexions.php?logout" style="color: #ff4d4d; text-decoration: none;">🚪 Se déconnecter</a>
        </div>
    </nav>
<?php $page = 'profil'; ?>
<?php if($page == 'profil'): ?>
    <main style="flex: 1; padding: 30px; background-color: #f8f9fa;">
    <h1>The World of Travelers</h1>
    <h2>Le site de voyage pour les curieux et les aventuriers</h2>
<div class="container" style="margin-top: 20px; text-align: left;">
    <h3 style="text-align: center;">🔍 Assistant de Voyage Intelligent</h3>
    <form method="POST" action="#resultat">
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <div>
                <label>🌡️ Climat :</label><br>
                <select name="climat" required>
                    <option value="chaud">Chaud / Tropical</option>
                    <option value="frais">Frais / Montagne</option>
                    <option value="tempere">Tempéré</option>
                </select>
            </div>
            <div>
                <label>🏃 Activité :</label><br>
                <select name="activite" required>
                    <option value="aventure">Aventure & Sport</option>
                    <option value="detente">Détente & Plage</option>
                    <option value="culture">Culture & Ville</option>
                </select>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" name="recommander" style="background: #E65100; color: white; border: none; padding: 10px 25px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Trouver ma destination idéale
            </button>
        </div>
    </form>

    <?php
    if (isset($_POST['recommander'])) {
        $climat = $_POST['climat'];
        $activite = $_POST['activite'];

        // On cherche en base de données les pays qui correspondent aux deux critères
        $query = $pdo->prepare("SELECT * FROM liste_pays WHERE tags LIKE ? AND tags LIKE ? LIMIT 1");
        $query->execute(["%$climat%", "%$activite%"]);
        $result = $query->fetch();

        echo "<div id='resultat' style='margin-top: 30px; padding: 20px; background: #fff; border-left: 5px solid #E65100; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>";
        if ($result) {
            echo "<h4>✨ Notre recommandation pour vous :</h4>";
            echo "<div style='display: flex; align-items: center; gap: 20px;'>";
            echo "<img src='images/" . htmlspecialchars($result['apercu']) . "' width='80' style='border-radius: 5px;'>";
            echo "<div>";
            echo "<strong>" . htmlspecialchars($result['nom']) . "</strong><br>";
            echo "<small>" . htmlspecialchars($result['desciption']) . "</small>";
            echo "</div>";
            echo "</div>";
            echo "<br><a href='liste_pays.php?page=" . $result['continent'] . "' style='color: #E65100; text-decoration: none; font-weight: bold;'>En savoir plus →</a>";
        } else {
            echo "<h4>🤔 Pas de correspondance parfaite...</h4>";
            echo "Mais l'Australie est toujours une valeur sûre pour commencer !";
        }
        echo "</div>";
    }
    ?>
</div>
    <h3>Choisissez votre continent</h3>
    <div class = "menu-continents">
<div class="continent-card">
    <p>L'Amérique, Terre de contrastes</p>
    <a href="liste_pays.php?page=Amerique">
        <img src="images/Amerique.png" alt="Drapeau Amerique">
    </a>
</div>
	<div class="continent-card">
    <p>L'Afrique, berceau de l'humanité</p>
    <a href="liste_pays.php?page=Afrique">
        <img src="images/UnionAfricaine.jpg" alt="Drapeau Union Africaine">
    </a>
</div>
<div class="continent-card">
    <p>L'Europe, terre de l'innovation</p>
    <a href="liste_pays.php?page=Europe">
        <img src="images/UnionEuropeenne.png" alt="Drapeau Union Européenne">
    </a>
</div>
<div class="continent-card">
    <p>l'Asie, le géant en puissance</p>
    <a href="liste_pays.php?page=Asie">
        <img src="images/Asie.png" alt="Drapeau sie">
    </a>
</div>
<div class="continent-card">
    <p>l'Océanie, Le souffle du Pacifique</p>
    <a href="liste_pays.php?page=Oceanie">
        <img src="images/Oceanie.png" alt="Drapeau sie">
    </a>
</div>
    <?php endif; ?>

</div>
</div>
<?php include('footer.php'); ?>
