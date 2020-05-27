<?php
include ("db_connexion.php");
if(isset($_POST['form680'])){

    if(!empty($_POST['pseudo'] and !empty($_POST['pass'] and !empty($_POST['repass']) and !empty($_POST['email'])))) {


        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pass = sha1($_POST['pass']);
        $pass2 = sha1($_POST['repass']);
        $mail = htmlspecialchars($_POST['email']) ;
        $mail2 = htmlspecialchars($_POST['email2']) ;


        $pseudolength = strlen($pseudo);

        if ($pseudolength <= 25 ){
            echo 'ok 1';
            $reqpseudo = $bdd->prepare('SELECT * FROM account WHERE pseudo = ?');
            $reqpseudo ->execute(array($pseudo));
            $pseudoexist = $reqpseudo->rowCount();

            if ($pseudoexist == 0) {

                echo 'ok 2';
                if ($mail == $mail2) {

                    echo 'ok 3';

                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                        echo 'ok 4';

                        $reqmail = $bdd->prepare("SELECT * FROM account WHERE email = ?");
                        $reqmail->execute(array($mail));
                        $emailexist = $reqmail->rowCount();

                        if ($emailexist == 0) {

                            echo 'ok 5';
                            if ($pass == $pass2) {

                                $req = $bdd->prepare('INSERT INTO account(pseudo,pass,email,date_inscription,online) VALUES (:pseudo,:pass,:email,CURDATE(),:online)');
                                $req->execute(array(
                                    ':pseudo' => htmlspecialchars($pseudo),
                                    ':pass' => htmlspecialchars($pass),
                                    ':email' => htmlspecialchars($mail),
                                    ':online' => 0
                                ));

                                $erreur = "votre compte a bien été crée !";
                            } else {
                                $erreur = 'le mot de passe correspond pas ';
                            }
                        } else {
                            $erreur = 'adresse mail déjà utilisé ';
                        }

                    } else {
                        $erreur = "votre adresse mail n'est pas valide";
                    }
                } else {
                    $erreur = ' email incorrect';
                }
            }
            else{
                $erreur = 'le pseudo a déjà utilisée !';
            }
        }
        else{
            $erreur = 'pseudo incorrect ';
        }

    }
    else{
        $erreur = "tout les champ doivent etre remplis";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>register</title>

</head>
<style>
    .bannier{
        padding-top: 56px;
        background-color:#4267b2;
        border-bottom:1px solid #29487d;
        color:#fff;
        width:100%
        position:absolute;
        width:100%;
        width:2000px;
        position:fixed;
        box-sizing: border-box ;

        top: -5px;
        right:0px;
        z-index:0;
        border: 1px solid transparent;
        width:100%
    }
    a{
        top: -10px;
        margin-right: 50px;
        list-style-type: none;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding-bottom: 5px;
        color:black;

        font-size: 0.8em;
        text-decoration: none;
        text-transform:uppercase;
        position:relative;


    }
    a:hover{

    }
    form{

        margin-top: 100px;
        text-align: center;
    }
</style>

<body>
<div class="bannier">
<a href="index.php">accueil</a>
</div>
<form action="inscription.php" method="post">

    <label for="pseudo">pseudo</label><br>
    <input type="text" name="pseudo" id="pseudo" value="<?php if (isset($pseudo)){ echo $pseudo ;} ?>"><br><br>


    <label for="pass">password</label><br>
    <input type="password" name="pass" id="pass" ><br><br>


    <label for="re-password">re-password</label><br>
    <input type="password" name="repass" id="repass" ><br><br>


    <label for="email">email</label><br>
    <input type="email" name="email" id="email" value="<?php if (isset($mail)){ echo $mail ;} ?> "><br><br>


    <label for="email2">confirmation email</label><br>
    <input type="email" name="email2" id="email2" value="<?php if (isset($mail2)){ echo $mail2 ;} ?>"><br><br>

    <input type="submit" name="form680">
</form>
<?php
if (isset($erreur)){
    echo $erreur;
}
?>

</body>

</html>