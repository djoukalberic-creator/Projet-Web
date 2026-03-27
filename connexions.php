<?php
session_start();
require_once('db.php'); // Toujours appeler le traducteur en premier
include('design.php');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
// 1. DÉCONNEXION
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: connexions.php'); 
    exit();
}

// 2. REDIRECTION SI DÉJÀ CONNECTÉ
if (isset($_SESSION['nickname'])) {
    header('Location: pagePrincipale.php');
    exit();
}

$error = "";

// 3. TRAITEMENT DU LOGIN
if (isset($_POST['login'], $_POST['pwd'])) {
    $pseudo = $_POST['login'];
    $mdp_saisi = $_POST['pwd'];

    // On cherche l'utilisateur dans la base MySQL
    $query = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
    $query->execute([$pseudo]);
    $user = $query->fetch();
// Si le compte a 3 échecs et que le dernier date de moins de 15 min
if ($user['tentatives'] >= 3 && strtotime($user['dernier_echec']) > strtotime("-15 minutes")) {
    die("Trop de tentatives. Revenez plus tard.");
}
    // On vérifie si l'utilisateur existe ET si le mot de passe est correct
    if ($user && password_verify($mdp_saisi, $user['password'])) {
        $_SESSION['nickname'] = $user['pseudo'];
        $_SESSION['role'] = (int)$user['role'];
         $_SESSION['avatar'] = $user['avatar'];
         $upd = $pdo->prepare("UPDATE utilisateurs SET tentatives = 0 WHERE pseudo = ?");
         $upd->execute([$pseudo]);
         $error = " succes";
         $message = date('d/m/Y H:i')  .$user['pseudo']  .$error;
         error_log($message ."\n", 3, "logs/systemsucces.log") ;
        header('Location: pagePrincipale.php');
        exit();
    } else {
        $error = " Pseudo ou mot de passe incorrect.";
        $upd = $pdo->prepare("UPDATE utilisateurs SET tentatives = tentatives + 1, dernier_echec = NOW() WHERE pseudo = ?");
        $upd->execute([$pseudo]);
        $message = date('d/m/Y H:i')  .$user['pseudo']  .$error;
        error_log($message ."\n", 3, "logs/systemfail.log");
    }
}
 
// 4. AFFICHAGE (Le Sandwich)
$fond = 'login';
include('design.php'); 
?>
<div class="container">
    <h1>Connexion world of travelers</h1>

    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="login" placeholder="Identifiant" required><br><br>
        <input type="password" name="pwd" placeholder="Mot de passe" required><br><br>
        <button type="submit">Se connecter</button>
    </form>
     <p style="margin-top: 15px; font-size: 0.9em;">
    <a href="motdepasse_oublie.php" style="color: #666; text-decoration: none;">
        Mot de passe oublié ?
    </a>
</p>
<p>Nouveau ici ? <a href="inscription.php">Créer un compte</a></p>
</div>
<?php include('footer.php'); ?>
