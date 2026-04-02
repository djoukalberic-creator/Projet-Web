<?php
include "config.php"; // utilise ta connexion InfinityFree

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = trim($_POST['pseudo']);
    $password = trim($_POST['password']);

    if (!empty($pseudo) && !empty($password)) {

        // Requête sécurisée
        $stmt = $conn->prepare("SELECT * FROM users WHERE pseudo = ?");
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Si tu utilises password_hash()
            // if (password_verify($password, $user['password'])) { ... }

            if ($password === $user['password']) { // version simple si tu n'as pas hashé
                echo "Connexion réussie ! Bienvenue " . htmlspecialchars($pseudo);
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Utilisateur introuvable.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<form method="POST" action="">
    <label for="pseudo">Pseudo</label>
    <input type="text" placeholder="Entrez votre pseudo..." id="pseudo" name="pseudo" required>

    <label for="password">Mot de passe</label>
    <input type="password" placeholder="Entrez votre mot de passe..." id="password" name="password" required>

    <input type="submit" value="Se connecter" name="ok">
</form>

</body>
</html>
