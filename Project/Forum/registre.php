<?php
include ('db_connexion.php');
$rec = $bdd->query('SELECT pseudo, email FROM account ');


$verif = $bdd->prepare('SELECT pseudo , email FROM account');
$données = $verif->fetch();
if ($données['pseudo'] = $_POST['pseudo'] and $données['email'] = $_POST['email']){

    echo 'le pseudo et l\'email existe deja ';

    
}
else{
    $pass_hach = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $req = $bdd->prepare('INSERT INTO account(pseudo,pass,email,date_inscription,online) VALUES (:pseudo,:pass,:email,CURDATE(),:online)');
    $req ->execute(array(
        ':pseudo' => htmlspecialchars($_POST['pseudo']),
        ':pass' => htmlspecialchars($pass_hach),
        ':email' => htmlspecialchars($_POST['email']),
        ':online' => 0
    ));

    header('Location:index.php');
}


