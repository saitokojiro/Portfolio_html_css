<?php
include ("db_connexion.php");
include('db_connexion.php');
session_start();
if(isset($_SESSION['id']) and isset($_SESSION['pseudo']) ){
    $_SESSION['id'];

    $_SESSION['pseudo'];}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>register</title>

</head>
<style>
    .up{
        padding-top: 6px;
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
    li{
        top: 2px;
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
<?php
       if(isset($_SESSION['id']) and isset($_SESSION['pseudo'])) {
           ?>
           <div class="up">
               <ul>
                   <li>
                       connecté : <?php echo $_SESSION['pseudo']; ?>
                   </li>
                   <li>
                       <a href="index.php">accueil</a>
                   </li>
               </ul>


           </div>

           <?php


           ?>
           <form action="profil_post.php" method="post">
               <label>new password</label>
               <input type="password" name="newpass" id="newpass">
               <label>confirme new password</label>
               <input type="password" name="rnewpass" id="rnewpass">
               <input type="submit">
           </form>
           <?php
       }else{
           header('Location:index.php');
       }
?>
</body>
</html>
