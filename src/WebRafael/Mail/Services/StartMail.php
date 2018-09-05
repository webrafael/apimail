<?php

namespace Mail\Services;

use Mail\Config\Configuration as Config;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class StartMail
{
    static public function build()
    {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SetLanguage("en");
        $mail->IsHTML(true);
        $mail->ContentType   = "text/html";    // Define o tipo de conteúdo
        $mail->Port          = Config::get('SMTP_PORT');         // Porta a ser utilizada
        $mail->SMTPSecure    = Config::get('SMTP_SECURE');       // Criptografia ssl ou tls
        $mail->SMTPAuth      = Config::get('SMTP_AUTH');         // Se deve usar a autenticação SMTP. Usa as propriedades de nome de usuário e senha.
        $mail->SMTPDebug     = Config::get('SMTP_DEBUG');        // Qual debuger interagir
        $mail->Debugoutput   = Config::get('SMTP_DEBUG_OUTPUT'); // Tipo de saída no debuger
        $mail->Mailer        = Config::get('SMTP_MAILER');       // Usando protocolo SMTP
        $mail->Host          = Config::get('SMTP_HOST');         // Pegando dados do config
        $mail->CharSet       = Config::get('SMTP_CHARSET');      // Tipo de coleção de caracteres
        $mail->Username      = Config::get('SMTP_USER');         // Nome de usuário da conta de email
        $mail->Password      = Config::get('SMTP_SENHA');        // Senha da conta de email
        $mail->Sender        = Config::get('SMTP_USER');

        //Checa se existe user para cópia oculta
        if(Config::get('SMTP_BCC')) {
            $mail->addBcc(Config::get('SMTP_BCC'));
        }

        return $mail;
    }
}