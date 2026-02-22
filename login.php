<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "root";

try{
    $bdd = new PDO("mysql:host=$servername;dbname=db_projetweb", $username,$password);
    $bdd ->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
 }
catch (PDOException $e){
    echo "Erreur  : ".$e->getMessage(); 
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    if ($pseudo != "" && $password != ""){
        $req = $bdd ->query ("SELECT * FROM users WHERE pseudo =  '$pseudo' AND password = '$password'");
        $rep = $req->fetch();

    }
}

?>

    <form method="POST" action="">
        <label for="Pseudo">Pseudo</label>
        <input type="pseudo" placeholder="Entrez votre pseudo..." id="pseudo" name="Pseudo" required>
        <label for="password">Mot de passe </label>
        <input type="password" placeholder="Entrez votre Mot de passe..." id="password" name="password" required>
        <input type="submit" VALUES ="Se connecter" name="ok" >
    </form>
    
</body>
</html>

