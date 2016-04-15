<?php
function modeluserscore(PDO $pdo)
{
    $sql = "SELECT * FROM `userscore`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = [];
    while($row = $stmt->fetchObject()){
        $results[] = $row;
    }
    return $results;
}

// Foncion qui appel tout le super hero 

function findAll(PDO $pdo)
{
    $sql = "
SELECT
    `user`.`id`,
    `user`.`name`,
    `user`.`mail`,
    `user`.`id_score`,
    `userscore`.`u_score_id` as score
FROM
  `user`
INNER JOIN `userscore` ON `user`.`id_score` = `userscore`.`id`
";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = [];
    while($row = $stmt->fetchObject()){
        $results[] = $row;
    }
    return $results;
}

// Foncion qui appel un super hero par son id 

function findOne(PDO $pdo, $id)
{
    $sql = "
SELECT
    `user`.`id`,
    `user`.`name`,
    `user`.`mail`,
    `user`.`id_score`,
    `userscore`.`u_score_id` as score
FROM
  `user`
INNER JOIN `userscore` ON `user`.`id_score` = `userscore`.`id`
WHERE
  `user`.`id` = :id
";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchObject();
}

// Foncion ajoute un super hero

function insertuser(PDO $pdo, $user){
    $sql = "
INSERT INTO 
  `user`
(`name`, `u_score_id`, `id_score`) 
VALUES 
(:name, :score, :id_score)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $user['name'], PDO::PARAM_STR);
    $stmt->bindParam(':score', $user['score'], PDO::PARAM_STR);
    $stmt->bindParam(':id_score', $user['id_score'], PDO::PARAM_INT);
    $stmt->execute();
    return $pdo->lastInsertId();
}