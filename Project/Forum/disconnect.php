<?php
session_start();
$_SESSION['pseudo'];
include ('db_connexion.php');
$req = $bdd->prepare('UPDATE account SET online = 0 WHERE pseudo = :online ');
$req ->execute(array(
    ':online' => $_SESSION['pseudo']
));
header('Location:online.php');