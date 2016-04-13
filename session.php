<?php

if( !$_POST['mail'] ){
    echo "Veuillez rentrer une adresse mail valide";
} if( !$_POST['pwd'] ){
    echo "Veuillez rentrer un mot de passe valide"
} else {}
$algo = 'sha512';
$email = (string) $_POST['mail'];
$password = (string) $_POST['pwd'];
$password = (string) hash( (string)$algo, (string)$password );



$sql = "SELECT * FROM user WHERE pwd LIKE '".$password."' AND mail LIKE '".$email."';";


$stmt=$conn->prepare( $sql );
$stmt->execute();
$row = $stmt->fetch();

if( !empty($row) ) {
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $sId;

    header('location: http://localhost/webook/profile.php?id='.$row['id']);
} else {
    header('location: http://localhost/webook/content.php?error=notFound');
}