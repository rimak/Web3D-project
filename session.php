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



$pwd = hash("sha512", $_POST["pwd"]);
$sql = "INSERT INTO user( `name`, `pwd`, `mail` )
VALUES (':name', ':pwd', ':mail');
SELECT @userid := `id`
FROM user
WHERE `id` = LAST_INSERT_ID();
UPDATE user
SET `u_achievement_id` = @userid, `score_id` = @userid
WHERE `id` = @userid;
INSERT INTO userScore( `u_score_id`)
VALUES (@userid);
INSERT INTO userAchiev( `user_id`)
VALUES (@userid);";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':pwd', $pwd);
$stmt->bindParam(':mail', $_POST['mail']);
$stmt->execute();

if ($login == '') {
    header('location: index.php?error=1');
}elseif ($password = '' ){
    header('location : index.php?error=2&password'.$password);
}else {
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['logged'] = true;

    header('location : profil.php');
}