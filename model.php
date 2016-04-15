<?php
// call all user's informations (score + achievements)
function getInfo( PDO $pdo, $id ){
    $sql = "SELECT u.*, uA.*, a.*, uS.*
FROM user as u
INNER JOIN userAchiev as uA
ON u.u_achievement_id = uA.user_id
INNER JOIN achievements as a
ON uA.user_id = a.a_user_id
INNER JOIN userScore as uS
ON u.score_id = uS.u_score_id
WHERE u.id = $id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = [];
    while( $row = $stmt->fetchObject() ){
        $results[] = $row;
    }
    return $results;
}
// call all user's achievements
function findAchievements ( PDO $pdo, $id ){
    $sql = "SELECT u.*, uA.*, a.*
FROM user as u
INNER JOIN userAchiev as uA
ON u.u_achievement_id = uA.user_id
INNER JOIN achievements as a
ON uA.user_id = a.a_user_id
WHERE u.id = $id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = [];
    while( $row = $stmt->fetchObject() ){
        $results[] = $row;
    }
    return $results;
}
// update user informations
function updatePlayer( PDO $pdo, $id )
{
    $sql = "UPDATE user
SET `name` = ':name', `pwd` = ':pwd', `mail` =  ':mail'
WHERE `id` = $id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':name', $_POST['name'], PDO::PARAM_STR );
    $stmt->bindParam( ':pwd', $_POST['pwd'], PDO::PARAM_STR );
    $stmt->bindParam( ':mail', $_POST['mail'], PDO::PARAM_STR );
    $stmt->execute();
}
// create new user
function createPlayer( PDO $pdo ){
    // insert new user basic infos
    $sql = "INSERT INTO user( `name`, `pwd`, `mail` )
VALUES (':name', ':pwd', ':mail');";
    $hash_pwd = ($_POST['pwd']);
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':name', $hash_pwd, PDO::PARAM_STR );
    $stmt->bindParam( ':pwd', $_POST['pwd'], PDO::PARAM_STR );
    $stmt->bindParam( ':mail', $_POST['mail'], PDO::PARAM_STR );
    $stmt->execute();
    $sql = "SELECT `id`
    FROM user;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $id = $stmt->fetchObject();
    // give id to all childs
    $sql = "INSERT INTO user( `u_achievement_id`, `score_id` )
VALUES (':id1', ':id2');";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':id1', $id, PDO::PARAM_INT );
    $stmt->bindParam( ':id2', $id, PDO::PARAM_INT );
    $stmt->execute();
    $sql = "INSERT INTO userScore( `u_score_id`)
VALUES (':id');";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
    $stmt->execute();
    $sql = "INSERT INTO userAchiev( `user_id`)
VALUES (':id');";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
    $stmt->execute();
}
function createUser( PDO $pdo ){
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
}
// score update (end of the game/after sign in)
function updateScore( PDO $pdo, $id ){
    $str_json = $_POST['JSON'];
    $score = json_decode($str_json);
    $sql = "UPDATE userScore
SET `score` = ':score')
WHERE `id` = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':score', $score, PDO::PARAM_STR );
    $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
    $stmt->execute();
}
function newSuccess(){
}