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
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'insira seu email'; // INSIRA O SEU EMAIL (PARA AUTENTICAR NO SMTP)
        $mail->Password   = 'insira a senha'; // INSIRA A SENHA
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('Insira o email do remetente', 'Erickson - Remetente'); //remetente
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
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Não foi possível enviar a mensagem. Descrição do erro: {$mail->ErrorInfo}";
    }
    //fim da instanciação da classe PHPMailer

?>