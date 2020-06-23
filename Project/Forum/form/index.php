<?php
include 'db_connexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Mon blog</title>
    <link href="form/style.css" rel="stylesheet" />
</head>

<body>
    <div class="menu"></div>
    <h1></h1>
    <p>Derniers billets du blog :</p>
    <a href="form/creation_forum.php">new form</a>
    <?php

$rep = $bdd->query('SELECT id, titre, username, message, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM forum_chat ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $rep->fetch()) {
    ?>

    <div class="new">

        <em>de: </em><?php echo nl2br(htmlspecialchars($donnees['username'])); ?><br>
        <h3>
            <?php echo htmlspecialchars($donnees['titre']); ?>
            <em>le : <?php echo $donnees['date_creation_fr']; ?></em>
        </h3>
        <p>
            <?php

    echo nl2br(htmlspecialchars($donnees['message']));
    ?>
            <br>
            <br>
            <em><a href="form/commentaire.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em><br>
            <br>
            <em><a class="delete" href="form/delet.php?billet=<?php echo $donnees['id']; ?>">Delete</a></em>


        </p>

    </div>
    <?php
}
$rep->closeCursor();
?>
</body>

</html>