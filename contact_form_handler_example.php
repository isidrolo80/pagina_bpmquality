<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$errors = "";


$captcha;
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
 if(!$captcha){
        echo "<SCRIPT type='text/javascript'> 
    alert('Por favor selecciona el captcha antes de enviar el formulario');
    window.location.replace(\"index.html\");
    </SCRIPT>";
    exit;
}
$secretKey = "6LcMAD4UAAAAALzdu7iYxu8WhxL6Q-KrHKYmZKO0";
$ip = $_SERVER['107.180.51.35'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
$responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          echo '<script>alert("No pudimos verificar que eres humano"); </script>';
        } else {
          echo "<script>alert('Mensaje enviado con éxito');</script>";
        }


$mail = new PHPMailer(true);       
if(empty($_POST['name'])  ||
   empty($_POST['email']) ||
   empty($_POST['message']))
{
    $errors .= "\n Error: Todos los campos son requeridos";
}
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];


                       // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'a2plcpnl0465.prod.iad2.secureserver.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@pilisimas.com';                 // SMTP username
    $mail->Password = 'Dontgo1992';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@pilisimas.com', 'BPM Quality At Pilisimas');
    //$mail->addAddress('info@ecuadortreasure.com', 'Chuquiragua Lodge');     // Add a recipient
    $mail->addAddress($email_address, $name);     // Add a recipient
    $mail->addReplyTo('administrativo@bpmquality.com', 'Información');


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Formulario de Contacto BPM Quality exitoso';
    $mail->Body    = 'Informacion de email: </br> 
    				  <b>Nombre: </b>'.$name.'
    				  <b>Email:  </b>'.$email_address.'
    				  <b>Mensaje: </b>'.$message;
    $mail->AltBody = 'Formulario de contacto en BPM Quality completado. Nombre: '.$name.' Email: '.$email_address.' Mensaje: '.$message;

    $mail->send();
    //echo '<script>alert("Email enviado con Exito");</script>';
    //header("Location: index.php");
    echo "<SCRIPT type='text/javascript'> 
    alert('Formulario enviado con exito');
    window.location.replace(\"index.html\");
    </SCRIPT>";
	die();
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}




?>