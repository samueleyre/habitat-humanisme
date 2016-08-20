<?php

include 'db.php';
include 'header.php';
require 'PHPMailerAutoload.php';


if(isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['school']) && isset($_POST['password']) ) {

  //  entrer données dans la bdd
  $prenom = htmlspecialchars($_POST['surname']);
  $nom=htmlspecialchars($_POST['name']);
  $mail=$_POST['email'];
  $school=$_POST['school'];
  $mdp=$_POST['password'];
  //filtrer le mail au bon format
  if((filter_var($mail, FILTER_VALIDATE_EMAIL))) {
    //verification du mail dans bdd
    $reqmail = $cnx->prepare("SELECT * FROM etudiants WHERE mail = ?");
    $reqmail->execute(array($mail));
    $mailexistant = $reqmail->rowCount();
    //verifier si le mail exsiste dans la base de donnée s'il n'exsiste pas on continue
    if ($mailexistant == 0) {

      $code_activation = md5(uniqid(rand()));
      $rqinsert = $cnx->prepare("INSERT INTO etudiants(nom, prenom, mdp,mail,school,code_activation, active) VALUES(?,?,?,?,?,?, ?)");
      $rqinsert->execute(array($nom, $prenom, $mdp, $mail, $school, $code_activation, 0 ));

      if ($rqinsert) {

        // $url_validation = "http://localhost:8000/#/login?code=" . $code_activation;
        $url_validation = "http://www.samueleyre.com/work/habethu/apptest/#/login?code=" . $code_activation;


        $m = new PHPMailer;

        // $m->SMTPDebug = 3;                               // Enable verbose debug output

        $m->isSMTP();                                      // Set mailer to use SMTP
        $m->Host = 'mail.gandi.net';  // Specify main and backup SMTP servers
        $m->SMTPAuth = true;                               // Enable SMTP authentication
        $m->Username = 'no-reply@samueleyre.com';                 // SMTP username
        $m->Password = 'samueleyretest';                           // SMTP password
        $m->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $m->Port = 465;                                    // TCP port to connect to

        $m->setFrom('no-reply@samueleyre.com', 'Habitat Humanisme');
        $m->addAddress($mail);     // Add a recipient
        // $m->addAddress('ellen@example.com');               // Name is optional
        $m->addReplyTo('no-reply@samueleyre.com', 'Habitat Humanisme');
        // $m->addCC('cc@example.com');
        // $m->addBCC('bcc@example.com');

        // $m->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $m->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $m->isHTML(true);                                  // Set email format to HTML

        $m->Subject = "Confirmation d'inscription";
        $m->Body    = "<h2>Bonjour ".ucwords($prenom).", </h2>
        </br>
        <p style=\"color: rgba(236,116,33,255);\">Pour terminer l'inscription cliquez sur le lien suivant : </p>
        <a href='$url_validation'> $url_validation </a></br>
        <p> Vous recevrez un email avec tous les d&eacute;tails de votre mission apr&egrave;s validation ! </p>
        <p> Bon courage !!! </p>
        <p style=\"color: rgba(0,163,231,255);\"> Habitat et Humanisme </p>
        <img src=\"http://www.samueleyre.com/work/habethu/apptest/images/house.png\">
        ";
        $m->AltBody = 'This is the body in plain text for non-HTML mail clients';


        if(!$m->send()) {
          $message = "error" . $m->ErrorInfo;
          $success = false;
          $test = ['success' => $success, 'message' => $message,'code'=>$code_activation];
          echo json_encode($test);
        } else {
          $message = "Votre compte a été créé, vous allez recevoir un email de confirmation.";
          $success = true;
          $test = ['success' => $success, 'message' => $message,'code'=>$code_activation];
          echo json_encode($test);
        }
      } else {

        $message = "error";
        $success = false;
        $test = ['success' => $success, 'message' => $message,'code'=>$code_activation];
        echo json_encode($test);

        }
      }
    }
  }
