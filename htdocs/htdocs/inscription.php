<?php
session_start();
include "config.php"; // utilise ta connexion mysqli

$msg = "";

if (isset($_POST['new_login'], $_POST['new_pwd'], $_POST['new_email'])) {

    $pseudo = trim($_POST['new_login']);
    $password = trim($_POST['new_pwd']);
    $email = trim($_POST['new_email']);

    // 1. Vérification du mot de passe
    if (strlen($password) < 8) {
        $msg = "Le mot de passe doit faire au moins 8 caractères.";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $msg = "Il faut au moins une majuscule.";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $msg = "Il faut au moins un chiffre.";
    } elseif (empty($email)) {
        $msg = "L'adresse email est obligatoire !";
    } else {

        // 2. Vérifier si le pseudo existe déjà
        $stmt = $conn->prepare("SELECT id FROM utilisateurs WHERE pseudo = ?");
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->fetch_assoc()) {
            $msg = "Ce pseudo est déjà pris !";
        } else {

            // 3. Hash du mot de passe
            $mdp_hache = password_hash($password, PASSWORD_DEFAULT);
            $role_client = 3;

            // 4. Insertion sécurisée
            $stmt = $conn->prepare("INSERT INTO utilisateurs (pseudo, mail, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $pseudo, $email, $mdp_hache, $role_client);

            if ($stmt->execute()) {
                $msg = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
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
