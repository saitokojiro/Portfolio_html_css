<?php
include '../db_connexion.php';
session_start();
if (isset($_SESSION['id']) and isset($_SESSION['pseudo'])) {
    $_SESSION['id'];

    $_SESSION['pseudo'];}

if (isset($_POST)) {

    $rep = $bdd->prepare('INSERT INTO forum_chat (titre, username , message ,  date_creation ) VALUE(?,?,?,NOW())');
    $rep->execute(array($_POST['titre'], $_SESSION['pseudo'], $_POST['message']));

    header('location:../index.php');

} else {
    echo 'error';
}