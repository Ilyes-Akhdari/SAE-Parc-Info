<?php
// inc/db.php
require_once __DIR__ . '/config.php';

// Connexion en mysqli procédural
$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$mysqli) {
    die('Erreur de connexion MySQL : ' . mysqli_connect_error());
}


