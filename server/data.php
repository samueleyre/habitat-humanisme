<?php


include 'db.php';
include 'header.php';

// reception de l'id de l'étudiant toutes les autres données concernent le passant
if(isset($_POST['id']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['email'])
&& isset($_POST['address']) && isset($_POST['zipcode']) && isset($_POST['city'])
&& isset($_POST['age']) && isset($_POST['question'])
&& isset($_POST['activity']) && isset($_POST['donation']) && isset($_POST['amount'])) {

    $idEtudiant=$_POST['id'];
    $prenomP =$_POST['surname'];
    $nom=$_POST['name'];
    $genre=$_POST['gender'];
    $mail=$_POST['email'];
    $adresse=$_POST['address'];
    $codePostal=$_POST['zipcode'];
    $ville=$_POST['city'];
    $age=$_POST['age'];
    $donnateur=$_POST['donation'];
    $question=$_POST['question'];
    $activity=$_POST['activity'];
    $montant= $_POST['amount'];

// Ajouter données dans la bdd
    //insertion des données

    $insertInfoPassant= $cnx->prepare("INSERT INTO `passants`(`idEtudiant`, `nom`, `prenom`, `mail`, `adresse`, `code_postal`,`ville`, `age`, `sexe`, `actif`, `donnation`, `dons`, `connaitreHabitat`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insertInfoPassant->execute(array($idEtudiant,$nom,$prenomP,$mail,$adresse, $codePostal, $ville,$age,$genre,$activity,$donnateur,$montant,$question));

    if($insertInfoPassant){

        $message = "vos infos sont bien enregistrés ";
        $success = true;
        $test = ['success' => $success, 'message' => $message];
        echo json_encode($test);
    }




}
