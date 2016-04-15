<?php
// connexion PDO
try{
    $pdo = new PDO('mysql:dbname=teletubbiesandkittens;host:localhost;charset=utf8','root','root');
} catch( PDOException $e){
    die("Boulet! ".$e->getMessage());
}
/**
 * fonction de requetage des pages
 * @param PDO $pdo
 * @param null|string $slug
 * @param null|int $id
 * @return array data
 */
function get(PDO $pdo, $slug = null, $id = null)
{
    $sql = "
SELECT
    *
FROM
    `page`
";
    // si criteres de selection, ajout du where
    if(!is_null($slug)||!is_null($id)){
        $sql .= "
WHERE
";
    }
    // init du stack de criteres
    $feignant = [];
    // si slug, ajout critere slug dans stack de criteres
    if(!is_null($slug)) {
        $feignant[] = "
`slug` = :slug
";
    }
    // si id, ajout critere id dans stack de criteres
    if(!is_null($id)) {
        $feignant[] = "
`id` = :id
";
    }
    // depilage du stack de criteres avec colle "AND"
    $sql .= implode("\nAND ",$feignant);
    // preparation SQL
    $stmt = $pdo->prepare($sql);
    // bind slug
    if(!is_null($slug)) {
        $stmt->bindParam(':slug', $slug);
    }
    // bind id
    if(!is_null($id)) {
        $stmt->bindParam(':id', $id);
    }
    // execution SQL
    $stmt->execute();
    // init tableau output
    $data = [];
    // remplissage tableau output
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    // retour donnees
    return $data;
}
/**
 * encapsulation de l'appel à get() pour requete sans critere
 * @param PDO $pdo
 * @return array
 */
function getAll(PDO $pdo)
{
    return get($pdo);
}
/**
 * encapsulation de l'appel à get() pour requete sur un slug
 * @param PDO $pdo
 * @param $slug
 * @return mixed
 */
function getSlug(PDO $pdo, $slug)
{
    return current(get($pdo, $slug));
}
/**
 * encapsulation de l'appel à get() pour requete sur une ID
 * @param PDO $pdo
 * @param $id
 * @return mixed
 */
function getId(PDO $pdo, $id)
{
    return current(get($pdo, null, $id));
}
function increment(PDO $pdo, $id)
{
    getSlug($pdo,$_GET['id']);
    
}