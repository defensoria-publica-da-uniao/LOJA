<?php
@session_start();
require_once $_SESSION['PATH'] . 'model/MCategorias.php';

require 'email/PHPMailer.php';
require 'email/SMTP.php';


class enviaEmail {

    private $objEmail;
    private $destinatario;
    private $assunto;
    private $corpoEmail;

    public function __construct($destinatario, $assunto, $corpoEmail) {
        $this->objEmail = new PHPMailer(true);
        $this->destinatario = $destinatario;
        $this->assunto = $assunto;
        $this->corpoEmail = $corpoEmail;

        $this->Email();
    }

    public function Email() {
        try {
            // Configurações do servidor
            $this->objEmail->SMTPDebug = 0;
            $this->objEmail->isSMTP();
            $this->objEmail->Host = 'webmail.dpu.def.br';
            $this->objEmail->SMTPAuth = false;
            //$this->objEmail->Username = 'ascom@dpu.def.br';
            //$this->objEmail->Password = 'ascom@123';
            //$mail->SMTPSecure = 'tls';                            
            $this->objEmail->Port = 2520;

            // Remetente e Destinatário
            $this->objEmail->setFrom('loja_ascom@dpu.def.br', 'Mensagem Loja ASCOM');
            $this->objEmail->addAddress($this->destinatario);
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // Anexos
            //echo $this->caminho;
            //var_dump($this->caminho_anexos);


            // Conteúdo do Email
            $this->objEmail->isHTML(true);
            $this->objEmail->CharSet = 'UTF-8';
            $this->objEmail->Subject = $this->assunto;
            $this->objEmail->Body = $this->corpoEmail;

            $this->objEmail->send();
     

        } catch (Exception $e) {
            
            // ERRO QUANDO NÃO ENVIA O E-MAIL
 echo 'Falha ao enviar mensagem. E-mail Error: ', $this->objEmail->ErrorInfo;
        }
    }

}
$oEnviaEmail = new enviaEmail();
$classe = 'EnviaEmail';
$oBjeto = $oEnviaEmail;
@include_once '../application/request.php';

