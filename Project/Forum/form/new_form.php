<?php
include ('../db_connexion.php');
session_start();
if(isset($_SESSION['id']) and isset($_SESSION['pseudo']) ){
    $_SESSION['id'];

    $_SESSION['pseudo'];}
if (!empty($_GET['billet']) AND !empty($_SESSION['pseudo']) AND !empty($_POST['commentaire'])) {

    $req = $bdd->prepare('INSERT INTO commentaire(id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())') or die(print_r($bdd -> getMessage()));
    $req->execute(array(
        ':id_billet' => htmlspecialchars($_GET['billet']),
        ':auteur' => htmlspecialchars($_SESSION['pseudo']),
        ':commentaire' => htmlspecialchars($_POST['commentaire'])
    ));

    header('location:commentaire.php?billet='.$_GET['billet']);

}
