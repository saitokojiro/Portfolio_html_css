<?php
include ('../db_connexion.php');
if(isset($_GET['billet'] )){
   $del = $bdd->prepare('DELETE FROM forum  WHERE id = :id');
    $dels = $bdd->prepare('DELETE FROM  commentaire WHERE id_billet = :ids');
    $dels ->execute(array(
        'ids' => $_GET['billet']
    ));

   $del ->execute(array(

       ':id'=> $_GET['billet']
   ));


}
header('LOCATION:../index.php')
?>