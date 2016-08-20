<?php

include 'db.php';
include 'header.php';
require 'PHPMailerAutoload.php';



if(isset($_POST['code'])) {

  $code = $_POST['code'];
  $reqStudent = $cnx->prepare("SELECT * FROM etudiants WHERE code_activation = ?");
  $reqStudent->execute(array($code));
  $numberStudent = $reqStudent->rowCount();
  $student = $reqStudent->fetch();





  if ($numberStudent) {
     $activeStudent = $cnx->prepare("UPDATE etudiants SET active = 1 WHERE code_activation = ?");
     $activeStudent->execute(array($code));
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
     // $m->addAddress('samuel.eyre73@gmail.com');               // Name is optional
     $m->addReplyTo('no-reply@samueleyre.com', 'Habitat Humanisme');
     // $m->addCC('cc@example.com');
     // $m->addBCC('bcc@example.com');

     // $m->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
     // $m->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     $m->isHTML(true);                                  // Set email format to HTML

     $m->Subject = "A vous de jouer !";
     $m->Body    = "

     <h2 style=\"color: rgba(236,116,33,255);\"> Nous venons de confirmer votre inscription ! </h2>

     </br>

     <p> Vous pouvez d&egrave;s &agrave; pr&eacute;sent vous connecter et faire remplir le questionnaire. </p>

     <p> Un point important sur l'utilisation de l'application :  </p>

     <p>  - Tous les champs de la page coordonn&eacute;es ne doivent pas obligatoirement &ecirc;tre remplis pour valider le questionnaire. </p>

     <p> On vous invite &agrave; pr&eacute;sent &agrave; lire ci-dessous les r&egrave;gles du jeu en d&eacute;tail pour &ecirc;tre au top pendant la journ&eacute;e !  </p>

     <p> Bonne chance ! </p>

     <p style=\"color: rgba(0,163,231,255);\"> L'équipe d'Habitat et Humanisme </p>

     <img src=\"http://www.samueleyre.com/work/habethu/apptest/images/house.png\">
     </br></br>
     <h2> Les r&egrave;gles du jeu :</h2>
     </br>
     <p style=\"color: rgba(236,116,33,255); margin-left : 20px;\"><b><u> Contact avec les passants</u></b></p>

     <p style=\"color: rgba(0,163,231,255);\"> Accueillir chaque passant avec le sourire.</p>

     <p style=\"color: rgba(236,116,33,255);\"> Se pr&eacute;senter : </p>

     <p style=\"color: rgba(0,163,231,255);\">&laquo;&#160;Bonjour, nous sommes &eacute;tudiants en 1&egrave;re ann&eacute;e de telle école et nous participons &agrave; l&rsquo;op&eacute;ration &laquo;&#160;une cl&eacute; pour les mal-log&eacute;s&#160;&raquo; de l&rsquo;association Habitat et Humanisme&#160;&raquo;. </p>

     <p style=\"color: rgba(236,116,33,255);\"> Pr&eacute;senter rapidement l&rsquo;association et le quizz : </p>
     <p style=\"color: rgba(0,163,231,255);\"> &laquo;&#160;Habitat et Humanisme lutte contre le mal logement en relogeant et en accompagnant des personnes en difficult&eacute;. Aussi, dans le but de sensibiliser le grand public &agrave; notre action et &agrave; la cause du mal-logement, nous vous proposons de participer gratuitement &agrave; un quizz tr&egrave;s simple et rapide. Suite &agrave; ce quizz, un tirage au sort avec de nombreux cadeaux &agrave; gagner aura lieu&#160;&raquo;.</p>

     <p style=\"color: rgba(236,116,33,255);\"> Remise d&rsquo;un objet, du tract et demande de dons :  </p>
     <p style=\"color: rgba(0,163,231,255);\">Pour vous remercier de votre participation vous nous remettons ce petit objet symbolique de l&rsquo;association ainsi que ce tract o&ugrave; vous retrouverez les coordonn&eacute;es de notre site internet et notre page Facebook &raquo;. &laquo; Souhaiteriez-vous faire un don symbolique pour Habitat et Humanisme ?</p>
     <p style=\"color: rgba(236,116,33,255);\"> En cas de questions sur la destination des dons : </p>

     <p style=\"color: rgba(0,163,231,255);\">&laquo; Tous les dons sont utilis&eacute;s par HH pour l&rsquo;acquisition, la r&eacute;habilitation ou l&rsquo;&eacute;quipement de logements ainsi que pour les projets sociaux. Cette ann&eacute;e la collecte sera affect&eacute;e &agrave; la r&eacute;novation d&rsquo;un lieu d&rsquo;h&eacute;bergement pour femmes avec ou sans enfant : la Maison des Amies du Monde dans le 5&egrave;me arrondissement. &raquo;. Sachez qu&rsquo;avec 15 euros, vous financez une nuit pour des personnes sans logement.</p>

     <p style=\"color: rgba(236,116,33,255); margin-left : 20px;\"><b><u> Cadeaux et tirage au sort </u></b></p>

     <p style=\"color: rgba(0,163,231,255);\">Les cadeaux &agrave; gagner sont les suivants : </p>

     <p>1 Cookeo Moulinex CE7041 100 recettes&#160;: valeur 199&euro; - 1 repas pour deux personnes au restaurant &laquo;&#160;Cinq Mains&#160;&raquo; de Gr&eacute;gory Cuilleron (Lyon 5)&#160;: valeur 70&euro; - 3 abonnements presse (Kiosque Cadeau &ndash; choix de la publication dans une liste non exhaustive)&#160;: valeur 29,90&euro; l&rsquo;unit&eacute; &ndash; </p>

     <p>2 Cours de cuisine Parent-Enfant &agrave; l&rsquo;Atelier des Chefs (dur&eacute;e 1h30)&#160;: valeur 57&euro; l&rsquo;unit&eacute; - 2 places de concert</p>

     <p>3 pochettes Cin&eacute;Ch&egrave;ques de 4 ch&egrave;ques (validit&eacute; 6 mois)&#160;: valeur 31,20&euro; la pochette de 4</p>

     <p style=\"color: rgba(236,116,33,255); margin-left : 20px;\"><b><u> Questions / R&eacute;ponses </u></b></p>

     <p style=\"color: rgba(0,163,231,255);\">1 &ndash; Lesquelles selon vous, sont des r&eacute;alisations d&rsquo;Habitat et Humanisme ? </p>

     <p style=\"color: rgba(0,163,231,255);\">R&eacute;ponse : <span style=\"color: rgba(236,116,33,255);\">TOUTES</span></p>

     <p style=\"color: rgba(0,163,231,255);\">2 - Selon vous, qui (quel profil de personnes) est touch&eacute; en priorit&eacute; par le mal-logement </p>

     <p style=\"color: rgba(0,163,231,255);\">R&eacute;ponse : <span style=\"color: rgba(236,116,33,255);\">TOUS</span> </p>

     <p style=\"color: rgba(0,163,231,255);\">3 - Dans quel arrondissement de Lyon ou commune, Habitat et Humanisme Rh&ocirc;ne propose-t-elle le plus de logements ?</p>

     <p style=\"color: rgba(0,163,231,255);\">R&eacute;ponse : <span style=\"color: rgba(236,116,33,255);\"> Centre de Lyon </span></p>

     <p style=\"color: rgba(0,163,231,255);\">4 - Quelles sont les valeurs d&eacute;fendues par Habitat et Humanisme ?</p>

     <p style=\"color: rgba(0,163,231,255);\">R&eacute;ponse : <span style=\"color: rgba(236,116,33,255);\">  B&acirc;tisseur de Lien / interg&eacute;n&eacute;rationnel / accompagnement </span> </p>
     ";

     $m->AltBody = 'This is the body in plain text for non-HTML mail clients';

     $m->send();

  } else {

    $success = false;
    $test = ['success' => $success];
    echo json_encode($test);

  }

}




 ?>
