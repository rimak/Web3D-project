<?php
/**
 * affiche la page de details d'un super hero
 * @param PDO $pdo
 */
function super_heroDetails(PDO $pdo)
{
    // recuperation de l'id du super hero a afficher
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = DEFAULT_SUPERHERO;
    }
    // recuperation des donnees de l'id
    $onesuper_hero = findOne($pdo, $id);
    // affichage de la vue avec les donnees
    details($onesuper_hero);
}
/**
 * affiche le formulaire ou process
 * les donnees soumises dans le formulaire
 * @param PDO $pdo
 */
function createuserscore(PDO $pdo)
{
    if(count($_POST) === 0){ // si pas de donnees en POST
        $userscoreList = modeluserscore($pdo); // recuperation de la liste des super pouvoirs
        viewCreate($userscoreList); // affichage de la vue
    } else {
        // creation
        $id = insertuser($pdo, $_POST); // insertion des donnees soumises dans le form
        header('Location: index.php?id='.$id); // redirection vers la page de details du nouveau super hero
    }
}

function headController(PDO $pdo){
    $everybody = findAll($pdo);
    head($everybody);
}