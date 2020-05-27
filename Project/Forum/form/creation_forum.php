<?php
session_start();
if(isset($_SESSION['id']) and isset($_SESSION['pseudo']) ){
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

<form action="formulaire.php" method="post">
    <p>
        <label for="pseudo" >titre</label><br>
        <input type="text" name="titre" id="titre"/><br>
        <label for="message">message</label><br>
        <input type="text" name="message" id="message"/><br>
        <input type="submit" value="envoyer"/>
    </p>
</form>



</body>
</html>
