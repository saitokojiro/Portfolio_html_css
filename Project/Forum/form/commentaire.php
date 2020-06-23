<?php
include '../db_connexion.php';
session_start();
if (isset($_SESSION['id']) and isset($_SESSION['pseudo'])) {
    $_SESSION['id'];

    $_SESSION['pseudo'];}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Mon blog</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>

    <div class="up">
        <nav>
            <ul>
                <li>bonjour :<aa> <?php echo $_SESSION['pseudo']; ?></aa>
                </li>
                <li><a href="../index.php">accueil</a> </li>
                <li><a href="../profil.php">password</a> </li>
                <li class="c"><a href="disconnect.php">deconnexion</a></li>
            </ul>
        </nav>
    </div>


    <div class="menu"></div>
    <h1></h1>
    <p><a href="../index.php">Retour à la liste des billets</a></p>

    <?php
if (isset($_GET['billet'])) {

    $rep = $bdd->prepare('SELECT id,username, titre, message, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\')AS date_creation_fr FROM forum_chat WHERE id = ?');
    $rep->execute(array($_GET['billet']));

    $donnees = $rep->fetch()

    ?>


    <div class="news">
        <a href="../index.php">retour</a>
        <h3>

            <?php echo htmlspecialchars($donnees['titre']); ?>

            <em> le <?php echo $donnees['date_creation_fr']; ?></em>
            <br> <br> <?php echo htmlspecialchars($donnees['username']); ?>
        </h3>

        <p>
            <?php
echo nl2br(htmlspecialchars($donnees['message']));
    ?>
        </p>
    </div>
    <h2>commentaires</h2>

    <?php

    ?>

    <?php
$rep->closeCursor();
    $rep = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaire WHERE id_billet = ? ORDER BY date_commentaire');
    $rep->execute(array($_GET['billet']));
    while ($donnees = $rep->fetch()) {
        ?>
    <div class="new">

        <p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong>
            le <?php echo $donnees['date_commentaire_fr']; ?></p>
        <p> <?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?> </p>
    </div>
    <?php
}
    $rep->closeCursor();

    ?>
    <div>
        <br><br>
    </div>
    <div class="chat">
        <form action="new_form.php?billet=<?php echo $_GET['billet'] ?>" method="post">

            <label for="chat"><em>votre text</em> </label><br>
            <textarea name="commentaire" id="chat" rows="10" cols="50" style=" resize: none;"
                placeholder="Votre commentaire"></textarea><br><br>
            <input type="submit" value="envoyer">


        </form>
        <?php
} else {
    echo 'page non existant';
}
?>



    </div>
</body>

</html>