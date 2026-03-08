
<?php
// 1. On appelle d'abord le cerveau qui connaît les secrets
require_once('config.php');

// 2. On utilise les constantes définies dans config.php
$host = DB_HOST;
$db   = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // 1. On prépare le message pour le journal
    $date = date('Y-m-d H:i:s');
    $messageErreur = "[$date] Erreur de connexion : " . $e->getMessage() . PHP_EOL;
    
    // 2. On l'écrit dans le fichier secret (le dossier 'logs' doit exister)
    error_log($messageErreur, 3, "logs/system_errors.log");

    if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
        die("🚨 ERREUR DÉVELOPPEMENT : " . $e->getMessage());
    } else {
        die("Indisponibilité temporaire du réseau IvoryTrain. Nos ingénieurs sont sur le coup.");
    }
} catch (\PDOException $e) {
     // En mode production, on ne montre jamais l'erreur brute au civil
     if (DEBUG_MODE) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
     } else {
         die("Erreur de connexion au réseau IvoryTrain. Veuillez contacter l'administrateur.");
     }
}
?>