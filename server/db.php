<?php


try{
    $cnx = new PDO('mysql:host=localhost; dbname=habitat;charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
    exit;
}


?>
