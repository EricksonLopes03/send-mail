<?php

//importação dos arquivos da biblioteca PHPMailer
require "./PHPMailer/Exception.php";
require "./PHPMailer/OAuth.php";
require "./PHPMailer/PHPMailer.php";
require "./PHPMailer/POP3.php";
require "./PHPMailer/SMTP.php";


//namespaces da biblioteca PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//classe Mensagem
class Mensagem
{
    private $email = null;
    private $assunto = null;
    private $mensagem = null;
    private $isEnviada = null;

    public function __construct($email, $assunto, $mensagem)
    {
        $this->email = $email;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function isDadosValidos()
    {
        if (empty($this->email) || empty($this->assunto) || empty($this->mensagem)) {
            header('Location: index.php');
        }
    }
}

//instanciando objeto mensagem já com os valores  
$mensagem = new Mensagem($_POST['email'], $_POST['assunto'], $_POST['mensagem']);
$mensagem->isDadosValidos();

//instanciando classe PHPMailer e setando configurações iniciais
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'INSIRA AQUI O SEU E-MAIL'; // INSIRA O SEU EMAIL (PARA AUTENTICAR NO SMTP)
    $mail->Password   = 'INSIRA AQUI A SENHA'; // INSIRA A SENHA
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('INSIRA AQUI O E-MAIL DO REMETENTE', 'Erickson - Remetente'); //e-mail do remetente
    $mail->addAddress($mensagem->__get('email'), 'Erickson - Destinatário');     //destinatário
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information'); //e-mail cujo qual a resposta do destinatário será direcionada
    //$mail->addCC('cc@example.com'); //copia
    //$mail->addBCC('bcc@example.com'); //copia oculta

    // Attachments - anexos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $mensagem->__get('assunto'); //assunto
    $mail->Body    = $mensagem->__get('mensagem'); // corpo que possui suporte para tags html
    $mail->AltBody = $mensagem->__get('mensagem'); // corpo alternativo para clientes que nao tem suporte para tags html
    $mail->send();
    $mensagem->__set('isEnviada', true);
} catch (Exception $e) {
    $mensagem->__set('isEnviada', false);
    print($mensagem->__get('isEnviada'));
}
//fim da instanciação da classe PHPMailer

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Send Mail</title>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <img src="img/logo.png" alt="logo" class="img-fluid" width="250px">
            <h2>Send Mail</h2>
            <p>O seu aplicativo pessoal para envio de e-mails!</p>
        </div>

        <!-- teste para verificar se o email foi enviado com sucesso -->
        <?php if ($mensagem->__get('isEnviada')) { ?>
            <div class="py-5">
                <h1 class="text-success">Sucesso!</h1>
                <p>O e-mail foi enviado com sucesso.</p>
                <a href="index.php" class="btn btn-success">Voltar</a>
            </div>
        <?php } else { ?>
            <div class="py-5">
                <h1 class="text-danger">Erro!</h1>
                <p>Houve um erro ao enviar o e-mail. Tente novamente. (Erro: <?= $mail->ErrorInfo ?>)</p>
                <a href="index.php" class="btn btn-success">Voltar</a>
            </div>
        <?php } ?>
        <!-- fim teste -->
    </div>

</body>

</html>