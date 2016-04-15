<?php
// Connection a la database 
try{
    $pdo = new PDO('mysql:host=localhost;dbname=php_partiel','root','root');
    $pdo->query('set names UTF8;');
} catch(PDOException $e){
    die($e->getMessage());
}
