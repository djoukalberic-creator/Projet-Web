<?php
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

// On charge le fichier .env
loadEnv(__DIR__ . '/.env');

// 1. Paramètres de la Base de Données (On récupère depuis le .env)
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'projer_web_db');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? ''); 

// 2. Clés de Sécurité (Pour ton fichier notification_paiement.php)
define('PAYMENT_KEY_PRIVATE', $_ENV['PAYMENT_KEY_PRIVATE'] ?? '');

// 3. Paramètres du Système
define('NOM_APPLICATION', $_ENV['APP_NAME'] ?? 'IvoryTrain');
define('URL_SITE', $_ENV['APP_URL'] ?? 'https://localhost');

// 4. Mode de fonctionnement
define('DEBUG_MODE', ($_ENV['APP_ENV'] === 'development')); 

if (!DEBUG_MODE) {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>