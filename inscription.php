<?php
session_start();
require_once('db.php');

$msg = "";
if (isset($_POST['new_login'], $_POST['new_pwd'])) {
    // 1. D'abord, on vérifie la complexité du mot de passe
    if (strlen($_POST['new_pwd']) < 8) { 
        $msg = "Le mot de passe doit faire au moins 8 caractères."; 
    } elseif (!preg_match("/[A-Z]/", $_POST['new_pwd'])) {
        $msg = "Il faut au moins une majuscule.";
    } elseif (!preg_match("/[0-9]/", $_POST['new_pwd'])) {
        $msg = "Il faut au moins un chiffre.";
    } 
    // --- NOUVELLE VÉRIFICATION ICI ---
    elseif (empty($_POST['new_email'])) {
        $msg = "L'adresse email est obligatoire !";
    } 
    // ---------------------------------
    else {
        // 2. Si le mot de passe est OK, on prépare les variables
        $pseudo = $_POST['new_login'];
        $mdp_hache = password_hash($_POST['new_pwd'], PASSWORD_DEFAULT);
        $role_client = 3;

        // 3. On vérifie si le pseudo est déjà pris
        $verif = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
        $verif->execute([$pseudo]);

        if ($verif->fetch()) {
            $msg = "Ce pseudo est déjà pris !";
        } else {
            $email = $_POST['new_email'];
            $ins = $pdo->prepare("INSERT INTO utilisateurs (pseudo, mail, password, role) VALUES (?, ?, ?, ?)");
            $success = $ins->execute([$pseudo, $email, $mdp_hache, $role_client]);

            if ($success) {
                $sujet = "Bienvenue dans l'Empire des voyageurs !";
                $message = "Bonjour $pseudo, bienvenue à vous";
                $headers = "From: le monde des voyageurs <contact@boulangerieatsam.be>";
    
    //mail($email, $sujet, $message, $headers); // Et paf, le mail part !
            } else {
                $msg = "Erreur technique lors de l'inscription.";
            }
        }
    }
}

$fond = 'login';
include('design.php');
?>

<div class="container">
    <h1>Créer un compte</h1>
    <?php if ($msg): ?> <p><?= $msg ?></p> <?php endif; ?>

    <form method="POST">
        <input type="text" name="new_login" placeholder="Choisissez un pseudo" required><br><br>
        <input type="password" name="new_pwd" placeholder="Choisissez un mot de passe" required><br><br>
        <input type="email" name="new_email" placeholder="Votre adresse email" required>
        <button type="submit">S'inscrire</button>
    </form>
    <br>
    <a href="connexions.php">Retour à la connexion</a>
</div>

<?php include('footer.php'); ?>