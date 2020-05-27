<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=id4920175_test;charset=utf8','id4920175_test','q%oqtX^yp^F3w&ikseh(');
}
catch (Exception $e){
    die('error'. $e->getMessage());
}