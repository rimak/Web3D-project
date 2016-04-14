<?php
/**
 * Created by PhpStorm.
 * User: Shark Riper
 * Date: 14/04/2016
 * Time: 12:55
 */
include_once '../pdo.php';
include_once '../controller.php';
/*include_once '../model.php';
include_once '../session.php';*/
/*include_once '../model.php';*/
?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import unity.css-->
    <link type="text/css" rel="stylesheet" href="css/unity.css"  media="screen,projection"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type='text/javascript' src='https://ssl-webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/jquery.min.js'></script>
    <script type="text/javascript" src='https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
    <script type="text/javascript">
        <!--
        var unityObjectUrl = "http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject2.js";
        if (document.location.protocol == 'https:')
            unityObjectUrl = unityObjectUrl.replace("http://", "https://ssl-");
        document.write('<script type="text\/javascript" src="' + unityObjectUrl + '"><\/script>');
        -->
    </script>
    <script type="text/javascript">
        <!--
        var config = {
            width: 960,
            height: 600,
            params: { enableDebugging:"0" }

        };
        var u = u || new UnityObject2(config);

        jQuery(function() {

            var $missingScreen = jQuery("#unityPlayer").find(".missing");
            var $brokenScreen = jQuery("#unityPlayer").find(".broken");
            $missingScreen.hide();
            $brokenScreen.hide();

            u.observeProgress(function (progress) {
                switch(progress.pluginStatus) {
                    case "broken":
                        $brokenScreen.find("a").click(function (e) {
                            e.stopPropagation();
                            e.preventDefault();
                            u.installPlugin();
                            return false;
                        });
                        $brokenScreen.show();
                        break;
                    case "missing":
                        $missingScreen.find("a").click(function (e) {
                            e.stopPropagation();
                            e.preventDefault();
                            u.installPlugin();
                            return false;
                        });
                        $missingScreen.show();
                        break;
                    case "installed":
                        $missingScreen.remove();
                        break;
                    case "first":
                        break;
                }
            });
            u.initPlugin(jQuery("#unityPlayer")[0], "../bizz.unity3d");
            console.log(u.getUnity().sendMessage());
            console.log(u.initPlugin);
        });
        -->
    </script>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">BI'ZZ</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="#!">Classement</a></li>
            <li><a href="#!"><i class="large material-icons">grade</i></a></li>
            <li><a class="modal-trigger" href="#modal1">Identifiez-vous</a></li>
            <li><a class="modal-trigger" href="#modal1"><i class="large material-icons">perm_identity</i></a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="#!">Classement</a></li>
            <li><a class="modal-trigger" href="#modal1">Identifiez-vous</a></li>
        </ul>
    </div>
</nav>
<?
if( !user_connected() ) { ?>
    <div id="modal1" class="modal modal-fixed-footer">
        <div id="mod" class="modal-content valign-wrapper">
            <h4 class="valign">SE CONNECTER</h4>
            <div class="container push">
                <form action='../session.php' method='post' class="col s12" >
                    <div class="input-field col s12">
                        <input id="name" type="text" name="name" class="validate">
                        <label for="name">Nom utilisateur</label>
                    </div>

                    <div class="input-field col s12">
                        <input id="pwd" type="password" name='pwd' class="validate">
                        <label for="pwd">Mot de passe</label>
                    </div>
                    <div class="input-field col s12">
                        <a id="start" class="waves-effect waves-light btn">S'inscrire</a>
                    </div>
                </form>
                <h4 id="appear" class="valign" style="visibility : hidden;">S'inscrire</h4>
                <form id='appear2' style="visibility : hidden;" action='../session.php' method='post' class="col s12" >
                    <div class="input-field col s12">
                        <input id="name" type="text" name="name" class="validate">
                        <label for="name">Nom utilisateur</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="mail" type="text" name='mail' class="validate">
                        <label for="mail">E-mail</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="pwd" type="password" name='pwd' class="validate">
                        <label for="pwd">Mot de passe</label>
                    </div>
                </form>
                <script>
                    $(document).ready(function(){
                        var $start = $('#mod');
                        var $appear = $('#appear');
                        var $appear2 =$('#appear2');

                        $start.click(function(){
                            $start.css("visibility", "hidden");
                            $appear.css("visibility", "visible");
                            $appear2.css("visibility", "visible");
                        });
                    });
                </script>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Retour</a>
        </div>
    </div>
<?php } if( user_connected() ) { ?>
    <div class="nav"><a href="<?= "./profile.php?id=".$_SESSION['id'] ?>">Profil | </a>

        <a href="<?= './profile.php?id='.$randId ?>">Profil aléatoire |</a>

        <a href="./profile_update.php">Modifier mon profil</a></div>
    <div class="nav2"><a href="<?= "" ?>">Déconnexion</a></div>
<?php } ?>
