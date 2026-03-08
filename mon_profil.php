<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['nickname'])) { header('Location: connexions.php'); exit(); }

// 1. On récupère TOUT sur l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
$stmt->execute([$_SESSION['nickname']]);
$user = $stmt->fetch();

include('design.php'); 
?>
 <div class="container" style="max-width: 600px; text-align: center;">
    <div style="width: 120px; height: 120px; border-radius: 50%; border: 4px solid #5bc0be; margin: 0 auto 20px; overflow: hidden;">
        <img src="<?= htmlspecialchars($_SESSION['avatar'] ?? 'images/avatar_default.jpg') ?>" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <h1 style="margin-bottom: 5px;\"><?= htmlspecialchars($_SESSION['nickname']) ?></h1>
    <p style="color: #5bc0be; font-weight: bold;">Client Fidèle de IvoryTrain</p>
    <?php if (isset($_GET['success_avatar'])): ?>
    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.9em; border: 1px solid #c3e6cb;">
        ✅ Votre photo de profil a été mise à jour avec succès !
    </div>
<?php endif; ?>
    <hr style=\"border: 0.5px solid rgba(255,255,255,0.1); margin: 20px 0;\">
    <div style="background: rgba(255,255,255,0.05); padding: 15px; border-radius: 10px;">
    <h3 style="font-size: 1em; margin-bottom: 10px;">📸 Changer ma photo</h3>
    <form action="upload_avatar.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="avatar_file" accept="image/*" style="font-size: 0.8em;" required>
        <button type="submit" style="background: #E65100; color: white; border: none; padding: 5px 15px; border-radius: 5px; cursor: pointer; margin-top: 10px;">
            Mettre à jour
        </button>
    </form>
</div>
</div>
<div class="container">
    <h1>👤 Mon Espace Client</h1>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        
        <div style="flex: 1; min-width: 300px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h3>Mes Informations</h3>
            <p><strong>Pseudo :</strong> <?= htmlspecialchars($user['pseudo']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['mail']) ?></p>
            <p>📅 <strong>Membre depuis :</strong> <?= date('d/m/Y', strtotime($user['date_inscription'])) ?></p>
        </div>

        <div style="flex: 1; min-width: 300px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h3>Mes pays préférés</h3>


                </div>
    </div>
</div>
<a href="PagePrincipale.php" style="background: #5bc0be; color: #0b132b; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Retour au tableau de bord</a>
