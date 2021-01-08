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
    class Mensagem {
        private $email = null;
        private $assunto = null;
        private $mensagem = null;

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

        public function isDadosValidos(){
            if(empty($this->email) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }
            return true;

        }
    }

    //instanciando objeto mensagem já com os valores  
    $mensagem = new Mensagem( $_POST['email'], $_POST['assunto'], $_POST['mensagem']);
    if(!$mensagem->isDadosValidos()){
        die();
    }

    //instanciando classe PHPMailer e setando configurações iniciais
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp1.example.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'user@example.com';                     // SMTP username
        $mail->Password   = 'secret';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        // Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Não foi possível enviar a mensagem. Descrição do erro: {$mail->ErrorInfo}";
    }
    //fim da instanciação da classe PHPMailer

?>