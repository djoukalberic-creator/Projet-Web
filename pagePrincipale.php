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
    <main style="flex: 1; padding: 30px; background-color: #f8f9fa;">
    <h1>The World of Travelers</h1>
    <h2>Le site de voyage pour les curieux et les aventuriers</h2>

    <h3>Choisissez votre continent</h3>
<div class = "menu-continents">
<div class="continent-card">
    <p>L'Amérique, Terre de contrastes</p>
    <a href="liste_amerique.html">
        <img src="images/Amerique.png" alt="Drapeau Amerique">
    </a>
</div>
	<div class="continent-card">
    <p>L'Afrique, berceau de l'humanité</p>
    <a href="liste_afrique.html">
        <img src="images/UnionAfricaine.jpg" alt="Drapeau Union Africaine">
    </a>
</div>
<div class="continent-card">
    <p>L'Europe, terre de l'innovation</p>
    <a href="liste_europe.html">
        <img src="images/UnionEuropeenne.png" alt="Drapeau Union Européenne">
    </a>
</div>
<div class="continent-card">
    <p>l'Asie, le géant en puissance</p>
    <a href="liste_asie.html">
        <img src="images/Asie.png" alt="Drapeau sie">
    </a>
</div>
</div>
<?php include('footer.php'); ?>
