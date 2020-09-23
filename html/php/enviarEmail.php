<?php
require_once('PHPMAiler/PHPMAilerAutoload.php');

$email = $_POST['email'];
$nombre = $_POST['nombre'];
$asunto = $_POST['asunto'];
$cuerpo = $_POST['cuerpo'];


$mail = new PHPMailer();
$email->isSMTP();
$email->SMTPAuth = true;
$email->SMTPSecure = 'tipo de seguridad';
$email->Host = 'smtp.hosting.com';
$email->Port = 'puerto';

$email->Username = 'miemail@dominio.com';
$email->Password = 'password';

$email->setFrom('miemail@dominio.com', 'Sistema de Usuarios');
$email->addAddress($email, $nombre);

$email->Subject = $asunto;
$email->Body = $cuerpo;
$email->isHTML(true);

if ($mail->sent())
    echo 'Notifacion enviada';
else
    echo 'Notificacion no enviada';
