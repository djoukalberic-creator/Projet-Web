<?php
session_start();
require_once("config.php");

// Si formulaire soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = $_POST["pseudo"] ?? "";
    $password = $_POST["password"] ?? "";

    // Préparation mysqli
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
    $stmt->bind_param("s", $pseudo);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Vérification utilisateur
    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["nickname"] = $user["pseudo"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["avatar"] = $user["avatar"];

        header("Location: pagePrincipale.php");
        exit();
    } else {
        $erreur = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion world of travelers</title>
</head>
<body>

<h2>Connexion world of travelers</h2>

<?php if (!empty($erreur)): ?>
    <p style="color:red;"><?= $erreur ?></p>
<?php endif; ?>

<form method="POST">
    <label>Identifiant</label><br>
    <input type="text" name="pseudo" required><br><br>

    <label>Mot de passe</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<a href="inscription.php">Créer un compte</a>

<?php include("footer.php"); ?>

</body>
</html>
