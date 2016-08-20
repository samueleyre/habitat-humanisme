<?php

include 'db.php';
include 'header.php';

if(isset($_POST['email']) && isset($_POST['password'])) {

    $mail = $_POST['email'];
    $mdp=$_POST['password'];

    $etudiantsrq = $cnx->prepare("SELECT * FROM  etudiants WHERE mail =? AND mdp=? AND active =?");
    $etudiantsrq->execute(array($mail,$mdp, 1));
    $etudiantexist=$etudiantsrq->rowCount();

    if($etudiantexist){
        $data=$etudiantsrq->fetch();
        $success = true;
        $name=$data['nom'];
        $surName=$data['prenom'];
        $id = $data['id_etudiant'];
        $message = "email ou motdepasse correct";

        $test = [ 'success'=>$success ,'message' => $message,  'data' => [ 'name' => $name, 'surname' => $surName, 'id' => $id]];
        echo json_encode($test);

    }
    else{
        $success = false;

    }
  }



// l'objet requis pour mon code
