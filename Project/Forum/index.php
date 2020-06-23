<?php
include 'db_connexion.php';
session_start();
if (isset($_SESSION['id']) and isset($_SESSION['pseudo'])) {
    $_SESSION['id'];

    $_SESSION['pseudo'];

}
if (isset($_POST['connect'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['pass'])) {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pass = htmlspecialchars(sha1($_POST['pass']));
        $onl = $bdd->prepare('UPDATE account SET online = 1 WHERE pseudo = :online');
        $onl->execute(array(
            ':online' => $pseudo,
        ));

        $reqUser = $bdd->prepare('SELECT * FROM account WHERE pseudo = ? AND pass = ?');
        $reqUser->execute(array($pseudo, $pass));
        $UserExist = $reqUser->rowCount();
        var_dump($reqUser);
        if ($UserExist == 1) {
            $userinfo = $reqUser->fetch();

            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            header('Location:index.php');
        } else {
            $msg = 'le compte n\'existe pas';
        }

    } else {
        $msg = 'tout les champs doivent etre remplis';

    }
} else {

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <title>accueil</title>

</head>

<body>

    <?php
if (isset($_SESSION['id']) and isset($_SESSION['pseudo'])) {

    ?><div class="ups">
        <header>
            <nav class="b">
                <ul>
                    <li>bonjour : <?php echo $_SESSION['pseudo']; ?></li>
                    <li><a href="profil.php">password</a> </li>
                    <li class="c"><a href="disconnect.php">deconnexion</a></li>
                </ul>
            </nav>


        </header>
    </div><br>
    <div class="colgauche">


        <article>

            <div>


                <h1>connect</h1><br>
                <?php
$rec = $bdd->query('SELECT pseudo, id FROM account WHERE online = 1 ');
    $rec->execute(array());
    while ($donnée = $rec->fetch()) {

        ?>
                <em><a href="profil.php?id=<?php echo $donnée['id'] ?>" style="text-decoration: none; color: red;"> <?php echo $donnée['pseudo'];
        echo ' ' . $donnée['id'] ?></a></em><br>
                <?php
// echo $donnée['pseudo'].'<br>';

    }
    $rec->closeCursor()

    ?>

            </div>
            <div>
                <h1>disconnect</h1>
            </div>
        </article>
    </div>
    <div class="form">
        <?php
include 'form/index.php';
    ?>
    </div>

    <?php

} else {
    ?>
    <div class="up">
        <header>
            <nav class="a">
                <ul>
                    <li class="adapte">accueil</li>

                    <li class="adapte"><a class="d" href="inscription.php">inscription</a></li>
                    <li>
                        <div>
                            <form action="index.php" method="post">
                                <label>pseudo</label>
                                <input type="text" name="pseudo" id="pseudo" size="10" style="width: 100px">
                                <label for="pass">password</label>
                                <input type="password" name="pass" id="pass" size="10" style="width: 100px">
                                <input type="submit" value="connect" id="connect" name="connect">
                            </form>


                        </div>
                    </li>

                </ul>

            </nav>
        </header><br>

    </div>
    <?php

}
?>

    </header><br>

    </div>
    <div class="connect">
        <?php
if (isset($msg)) {
    echo $msg;
}
?>
    </div>
</body>

</html>