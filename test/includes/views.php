<?php
function head(array $everybody)
{
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
</head>
<body>
    <nav>
        <ul>
<?php foreach($everybody as $oneuser):?>
            <li><a href="../index.php?id=<?=$oneuser->id?>"><?=$oneuser->score?> <?=$oneuser->score?></a></li>
<?php endforeach;?>
            <li><a href="../index.php?a=ajouter">Ajouter</a></li>
        </ul>
    </nav>
    <div id="content">
<?php
}

function foot()
{
?>
    </div>
</body>
</html>
<?php
}

function details($user)
{
?>
    <h1><?=$user->name?> <?=$user->score?></h1>
    <span><?=$user->name?></span><hr />
<?php
}

function viewCreate($userscoreList)
{
?>
    <form action="../index.php?a=ajouter" method="post">
        <input type="text" name="name" placeholder="name"/><br/>
        <input type="text" name="score" placeholder="score"/><br/>
        <input type="submit" value="Ajouter"/><br/>
    </form>
<?php
}