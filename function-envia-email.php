<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function envia_email( $nome, $email, $assunto, $msg ) {
	
	// Verifica se existe a classe, senão inclui
	if (!class_exists('PHPMailer\PHPMailer\Exception')){
		require 'phpmailer/src/Exception.php';
		require 'phpmailer/src/PHPMailer.php';
		require_once('phpmailer/src/SMTP.php');
	}

	// //Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	//Server settings
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();               
	$mail->Host       = 'servidor';
	$mail->SMTPAuth   = true;           
	$mail->Username   = 'naoresponda@email.com.br';
	$mail->Password   = 'email_senha@';                
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port       = 465;

	//Recipients
	$mail->setFrom( 'contato@email.com.br', 'Nome cliente' );
	$mail->addAddress( $email, $nome );     
	$mail->addReplyTo('contato@email.com.br', 'Nome cliente');

	//Content
	$mail->isHTML(true);
	$mail->Subject = "Avoip - ".$assunto;

	// Mensagem HTML
	$mensagem = '
	<html>
	<body style="background:#f0f0f0; padding:40px; margin:0">
	<div style="width: 500px; margin: auto; border: 1px solid #dfdfdf; background: #fff; padding: 40px">
		<div align="center"><img src="https://site.com.br/wp-content/uploads/2021/11/logo-e1638235616911.png" width="150"></div>
		<h2 align="center">'.$assunto.'  </h2><br />
		<p style="font-size: 14px"> <b> Olá '. $nome .',</b></p>
		<p style="font-size: 14px">'. $msg .'</p>
		<br>
		</p>
	</div>								
	</html>	
	</body>';

	$mail->Body = utf8_decode($mensagem);
	$mail->send();
}