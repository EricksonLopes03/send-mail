<?php 

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


?>