<?php

if( !$_POST['name'] ){
    echo "Veuillez rentrer une adresse mail valide";
} if( !$_POST['pwd'] ){
    echo "Veuillez rentrer un mot de passe valide";
} else {}
$algo = 'sha512';
$name = (string) $_POST['name'];
$password = (string) $_POST['pwd'];
$password = (string) hash( (string)$algo, (string)$password );



$sql = "SELECT * FROM user WHERE pwd LIKE '".$password."' AND mail LIKE '".$name."';";


$stmt=$pdo->prepare( $sql );
$stmt->execute();
$row = $stmt->fetch();

if( !empty($row) ) {
    session_start();
    $_SESSION['name'] = $name;
    $_SESSION['id'] = $sId;

    header('location: /index.php');
} else {
    header('location: /index.php');
}