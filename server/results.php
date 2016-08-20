<?php


include 'db.php';
include 'header.php';

if(isset($_POST['id'])) {
    $idEtudiant = $_POST['id'];
    $rqetudiant = $cnx->prepare("SELECT id_etudiant FROM etudiants WHERE id_etudiant = ?");
    $rqetudiant->execute(array($idEtudiant));
    $result = $rqetudiant->rowCount();


        $resultPassant = $cnx->prepare("SELECT COUNT(*) FROM passants WHERE idEtudiant = ? ");
        $resultPassant->execute(array($idEtudiant));
        //nbr de passants sondés
        $respondents = $resultPassant->fetchColumn();




$sql="SELECT SUM(dons) AS TOTAL1 FROM passants WHERE idEtudiant='$idEtudiant'";
                $resultotal1 = $cnx->query($sql);
                $resultotal1->execute();

    $total = $resultotal1->fetch();
    $totalAmount = $total['TOTAL1'];
    $success = true;
    $message = "Résultats à jour";


    $test = ['success' => $success, 'message' => $message, 'data' => ['respondents' => $respondents, 'totalamount' => $totalAmount]];
    //le bon format pour que je puisse interpreter.
    echo json_encode($test);




    }

    // l'objet requis pour mon code
