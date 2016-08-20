<?php

include 'db.php';
include 'header.php';
require 'PHPMailerAutoload.php';


if(isset($_POST['email'])) {


    $email = $_POST['email'];
    $reqStudent = $cnx->prepare("SELECT * FROM etudiants WHERE mail =?");
    $reqStudent->execute(array($email));
    $numberStudent = $reqStudent->rowCount();
    $student = $reqStudent->fetch();


    if ($numberStudent) {

       $success = true;
       $test = ['success' => $success];
       echo json_encode($test);

       //  send email
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
       $m->addAddress($student['mail']);     // Add a recipient

       $m->addReplyTo('no-reply@samueleyre.com', 'Habitat Humanisme');
       // $m->addCC('cc@example.com');
       // $m->addBCC('bcc@example.com');

       // $m->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
       // $m->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
       $m->isHTML(true);                                  // Set email format to HTML

       $m->Subject = "Recuperation";
       $m->Body    = "
       <h2 style=\"color: rgba(236,116,33,255);\"> R&eacute;cup&eacute;ration </h2>
       </br>
       <p> Votre mot de passe : ".$student['mdp']." </p>
       </br>
       <p> Habitat et Humanisme </p>
       <img src=\"http://www.samueleyre.com/work/habethu/apptest/images/house.png\">
       ";

       $m->AltBody = " Votre mot de passe :".$student['mdp'];

       $m->send();


    } else {

      $success = false;
      $test = ['success' => $success];
      echo json_encode($test);

    }


}


?>
