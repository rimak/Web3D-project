<?php
// inclusion des fichiers de declaration de fonctions
require_once './includes/settings.php';
require_once './includes/pdo.php';
require_once './includes/controllers.php';
require_once './includes/models.php';
require_once './includes/views.php';
// recuperation de l'action GET ou POST ou action par defaut
if(isset($_POST['a'])){ // si je trouve l'action dans le POST..
    $action = $_POST['a']; // je prends l'action
} elseif(isset($_GET['a'])){ // si je trouve l'action dans le GET..
    $action = $_GET['a']; // je prends l'action
} else { // sinon
    $action = DEFAULT_ACTION; // je prends le defaut (voir settings.php)
}
// affichage du head (avec la nav)
headController($pdo);
// appel des controlers en fonction de l'action
switch($action){
//    case 'modifier':
//        updatesuper_hero($pdo);
//        break;
//    case 'supprimer':
//        deletesuper_hero($pdo);
//        break;
    case 'ajouter': // ajout de super_hero
        createuser($pdo); // appel de la fonction de controller
        break;
    default: // details d'un super_hero
        userDetails($pdo); // appel de la fonction de controller
        break;
}
// affichage du footer (static)
foot();
?>