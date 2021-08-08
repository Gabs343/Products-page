<?php 

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require_once ('PHPMailer-master\src\PHPMailer.php');
require_once ('PHPMailer-master\src\Exception.php');
require_once ('PHPMailer-master\src\SMTP.php');

$mail = new PHPMailer(TRUE);

$mail->IsSMTP();

$mail->SMTPDebug  = 1;
$mail->Host       = 'smtp.gmail.com';
$mail->Port       = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth   = true;
$mail->Username   = "isaac.hernandez@davinci.edu.ar";
$mail->Password   = "diamonD10.";


$mail->SetFrom('isaac.hernandez@davinci.edu.ar', 'Isaac');

$mail->Subject = 'Consulta.';

$mail->Body = 'Saludos cordiales, espero que se encuentre bien. 

Mediante el presente correo, queremos informarle que hemos recibido su consulta. En los próximos días nos estaremos contactando con usted.

Le pedimos disculpa de antemano por la tardanza pero le aseguramos que estamos al tanto de su mensaje.

Hasta luego, Dimensión Gamer.';

date_default_timezone_set('UTC');

/*if ((isset($_POST["enviar"]))){
    $fecha = intval(date("YmdHis"));
    $query = "INSERT INTO contacto (nombre, apellido, email, celular, area, mensaje, fechaContacto) VALUES
    ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '$_POST[celular]', '$_POST[area]', '$_POST[mensaje]', $fecha)";
    $con = $this->db->connect();
    $con = $con->prepare($query);
    consulta('Muchas gracias por su consulta, '.$_POST["nombre"].', ya nos contactaremos con vos.');
    $mail->AddAddress('isaac.hernandez@davinci.edu.ar', $_POST["area"]);
    $mail->Send(); 
}*/


?>
