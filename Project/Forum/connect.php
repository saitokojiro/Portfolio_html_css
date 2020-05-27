<?php
include ('db_connexion.php');

$req = $bdd->prepare('SELECT id, pass,pseudo FROM account WHERE pseudo = :pseudo pass = :pass');
$onl = $bdd->prepare('UPDATE account SET online = 1 WHERE pseudo = :online');


$pseudo = $_POST['pseudo'];
$onl->execute(array(
    ':online' => $pseudo
));


$req->execute(array(
    ':pseudo' => htmlspecialchars($pseudo)));
$resultat =$req->fetch();



$passcorrect = sha1($_POST['pass'], $resultat['pass']);
if (!$resultat)
{
    header('Location:index.php');
}
else{
    if ($passcorrect){
        session_start();
        $_SESSION['id'] = $resultat['id'];

        $_SESSION['pseudo'] = $pseudo ;

        header('Location:index.php');
    }
    else{
        header('Refresh:2;url=index.php');
        echo 'error password';

    }
}