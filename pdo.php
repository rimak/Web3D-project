<?php
$dbname = "bizz";
$host = "localhost";
$user = "root";
$mdp = "root";

try {
    $pdo = new PDO( "mysql:dbname=$dbname;host=$host;charset=UTF8", $user, $mdp );
    $pdo->query( 'set names UTF8;' );
} catch ( PDOException $e ) {
    echo 'Connexion échouée : ' . $e->getMessage();
}