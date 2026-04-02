<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['nickname'])) { die("Accès refusé."); }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar_file'])) {
    $file = $_FILES['avatar_file'];
    
    // 1. Vérifications de base
    $extensions_valides = ['jpg', 'jpeg', 'png', 'gif'];
    $extension_upload = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($extension_upload, $extensions_valides)) {
        die("Erreur : Seules les images JPG, PNG et GIF sont autorisées.");
    }

    // 2. Création d'un nom unique (pour éviter les doublons sur le serveur)
    $nouveau_nom = "avatar_" . $_SESSION['nickname'] . "_" . time() . "." . $extension_upload;
    $chemin_destination = "images/" . $nouveau_nom;

    // Créer le dossier s'il n'existe pas
    if (!is_dir('images/profiles/')) { mkdir('images/profiles/', 0777, true); }

    // 3. Déplacement du fichier temporaire vers le dossier définitif
    if (move_uploaded_file($file['tmp_name'], $chemin_destination)) {
        
        // 4. Mise à jour de la Base de Données
        $update = $pdo->prepare("UPDATE utilisateurs SET avatar = ? WHERE pseudo = ?");
        $update->execute([$chemin_destination, $_SESSION['nickname']]);

        // 5. Mise à jour de la SESSION pour l'affichage immédiat
        $_SESSION['avatar'] = $chemin_destination;

        header("Location: mon_profil.php?success_avatar=1");
    } else {
        echo "Erreur lors du déplacement du fichier sur le serveur OVH.";
    }
}