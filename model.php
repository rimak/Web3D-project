<?php

// call all user's informations (score + achievements)
function getInfo( PDO $pdo, $id ){
    $sql = "SELECT u.*, uA.*, a.*, uS.*
FROM user as u
INNER JOIN userAchiev as uA
ON u.id = uA.user_id
INNER JOIN achievements as a
ON uA.achiev_id = a.a_user_id
INNER JOIN userScore as uS
ON u.score_id = uS.u_score_id
WHERE u.id = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
ON u.id = uA.user_id
INNER JOIN achievements as a
ON uA.achiev_id = a.a_user_id
WHERE u.id = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
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
WHERE `id` = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
    $stmt->bindParam( ':name', $_POST['name'], PDO::PARAM_STR );
    $stmt->bindParam( ':pwd', $_POST['pwd'], PDO::PARAM_STR );
    $stmt->bindParam( ':mail', $_POST['mail'], PDO::PARAM_STR );
    $stmt->execute();
}

function createUser( PDO $pdo ){
  // cryptage pwd
    $pwd = hash("sha512", $_POST["pwd"]);

    // create user -> select his id -> update user's foreign keys -> insert the same key into the other tables
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
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
    $stmt->execute();
}

// score update (end of the game/after sign in)
function updateScore( PDO $pdo, $id ){
    $str_json = $_POST['JSON'];
    $score = json_decode($str_json);


    $sql = "SELECT @deaths := `deaths`
FROM `userScore`
WHERE `u_score_id` = :id;

SELECT @lifetime := `lifetime`
FROM `userScore`
WHERE `u_score_id` = :id;

UPDATE userScore
SET `score` = '21', `deaths` = ( @deaths + 3 ), `time` = 18.55789, `lifetime` =  ( @lifetime + 120 - 18.55789 )
WHERE `u_score_id` = :id;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':score', $score, PDO::PARAM_STR );
    $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
    $stmt->execute();

}

function newSuccess(){

}
