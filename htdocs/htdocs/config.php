<?php
// Debug (à désactiver en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Petite fonction pour charger le .env manuellement
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

// On charge le fichier .env (si tu en utilises un)
loadEnv(__DIR__ . '/.env');

// Connexion MySQL InfinityFree
define('DB_HOST', 'sql310.infinityfree.com');
define('DB_NAME', 'if0_41492733_projet_web_db');
define('DB_USER', 'if0_41492733');
define('DB_PASS', '0TOSts7Ga2'); // ton vrai mot de passe

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Erreur de connexion MySQL : " . mysqli_connect_error());
}
