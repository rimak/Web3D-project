<?php

// call all the informations about the user (score + achievements)
function findAll(PDO $pdo){
    $sql = "SELECT u.*, p.*, a.*
FROM user as u
INNER JOIN user_achiev as uA
ON u.u_achievement_id = uA.user_id
INNER JOIN achievements as a
ON uA.user_id = a.a_user_id
INNER JOIN user_score as uS
ON u.score_id = uS.u_score_id
WHERE u.id = $id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = [];
    while($row = $stmt->fetchObject()){
        $results[] = $row;
    }
    return $results;
}


// call all the achievements of the user
function findAchievements(PDO $pdo){
    $sql = "SELECT u.*, p.*, a.*
FROM user as u
INNER JOIN user_achiev as uA
ON u.u_achievement_id = uA.user_id
INNER JOIN achievements as a
ON uA.user_id = a.a_user_id
WHERE u.id = $id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = [];
    while($row = $stmt->fetchObject()){
        $results[] = $row;
    }
    return $results;
}

function getDoubleJoin(PDO $pdo)
{
    $sql = "SELECT u.*, p.*, a.*
FROM user as u
INNER JOIN user_achiev as uA
ON u.u_achievement_id = uA.user_id
INNER JOIN achievements as a
ON uA.user_id = a.a_user_id
INNER JOIN user_score as uS
ON u.score_id = uS.u_score_id
WHERE u.id = $id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = [];
    while ($row = $stmt->fetchObject()) {
        $results[] = $row;
    }
    return $results;
}