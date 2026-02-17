<?php
session_start();
$_SESSION['ravaudeur'] = 'login';
echo 'bonjour' .  $_SESSION['ravaudeur'];
?><br>
<!Doctype html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<title> site de voyage  </title>
<img src = "images/carte-du-monde.jpg" alt="le monde"/><br/>
</head>
<body>
<form method="POST" action = "ProjetWebI.php">
login <input type="text" name = "login"><br>
passeworld <input type="password" name = "pwd"><br>
<input type="submit"><br>