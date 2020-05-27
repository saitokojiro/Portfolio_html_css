<?php
include ('db_connexion.php');
session_start();
$_SESSION['id'];
$_SESSION['pseudo'];
$mdp = $bdd ->prepare('UPDATE account SET pass = :passchange WHERE pseudo = :aid');
$passchange = sha1($_POST['newpass']);
$mdp ->execute(array(
    ':passchange'=> htmlspecialchars($passchange),
    'aid' => $_SESSION['pseudo']
));
?>

<?php

header('Location:index.php');
?>

