<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

 // Inclure le fichier PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST["submit"])) {

    // Récupérer les données du formulaire
    $nom = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
 
    // Instancier un nouvel objet PHPMailer
    $mail = new PHPMailer(true);

    // Paramètres de configuration pour Gmail
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Debug
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tonEmail';
    $mail->Password = 'TONMDP';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
    $mail->Port = 587; // PORT TLS

    // Paramètres de l'e-mail
    $mail->setFrom('no-reply-adress-cidos@gmail.com', "Mail Contact"); // ADDRESSE QUI  TENVOIE LE MAIL
    $mail->addAddress('toonEmail');
    $mail->isHTML(true);
    $mail->Subject = "Nouveau message contact CIDOS"; // OBJET
    $mail->Body = 'Nom: ' . $nom . '<br>' // BODY  EN HTML /PHP
                . 'Prénom: ' . $prenom . '<br>'
                . 'Email: ' . $email . '<br>'
                . 'Société: ' . $societe . '<br>'
                . 'Téléphone: ' . $tel . '<br>'
                . 'Message: ' . $message;

    // Envoi de l'e-mail
    if ($mail->send()) {
        echo "E-mail envoyé avec succès.";
    } else {
        echo 'Erreur lors de l'envoi de l'e-mail: ' . $mail->ErrorInfo;
    }
}

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'fontagne.bastien1@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>
