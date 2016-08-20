<?php

include 'db.php';
include 'header.php';

if(isset($_POST['schools'])) {

    $schoolsRq = $cnx->query("SELECT nom FROM etablissements");

    $schools = array();
    if ($schoolsRq->rowCount() > 0) {
      while($school = $schoolsRq->fetch()) {
             array_push($schools, $school['nom']);
      }
    }
    // echo $schools;
    $success = true;
    $message = "";

    if (sizeof($schools) === $schoolsRq->rowCount()) {
      $test = ['success' => $success, 'message' => $message, 'data' => ['schools' => $schools]];
      echo json_encode($test);
    }

  }




 ?>
