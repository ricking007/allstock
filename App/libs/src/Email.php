<?php
namespace App\libs;
use App\controllers\TemplateController;

class Email {

    public static function envia($destinatario, $destinatario_nome, $remetente, $remetente_nome, $conteudo, $assunto,$cc = 0) {
        date_default_timezone_set("Brazil/East");
        $to = $destinatario_nome . "<" . $destinatario . ">";
        $subject = $assunto;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html; charset=utf-8" . "\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        $headers .= "Reply-To: " . $remetente . "\r\n";
        $headers .= "Return-Path: " . $remetente . "\r\n";
        $headers .= "From: " . DEFAULT_REMETENTE_NOME . " <" . DEFAULT_REMETENTE_EMAIL . ">\r\n";
        if($cc){
            $headers .= 'Cc: '.$cc . "\r\n";
        }
        $headers .= "Bcc: abfurlan@gmail.com\r\n";
        $headers .= "Organization: ".ORGANIZACAO_NOME." \r\n";
        $msg = '<!DOCTYPE html>
                <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                </head>
                <body>
                    ' . $conteudo . '
                 </body>
                 </html>';
        $mail = @mail($to, $subject, $msg, $headers);
        if ($mail) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function enviaAnexo($to, $subject, $message, $from, $file){
      
        // $file should include path and filename
        $filename = basename($file['name']);
        //$file_size = filesize($file);
        $content = chunk_split(base64_encode(file_get_contents($file['tmp_name']))); 
        $uid = md5(uniqid(time()));
        $from = str_replace(array("\r", "\n"), '', $from); // to prevent email injection
        $header = "From: ".$from."\r\n"
            . "Bcc: abfurlan@gmail.com\r\n"
            ."MIME-Version: 1.0\r\n"
            ."Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n"
            ."This is a multi-part message in MIME format.\r\n" 
            ."--".$uid."\r\n"
            //."Content-type:text/plain; charset=utf-8\r\n"
            ."Content-type:text/html; charset=utf-8" . "\r\n"
            ."Content-Transfer-Encoding: 7bit\r\n\r\n"
            .$message."\r\n\r\n"
            ."--".$uid."\r\n"
            ."Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"
            ."Content-Transfer-Encoding: base64\r\n"
            ."Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n"
            .$content."\r\n\r\n"
            ."--".$uid."--"; 
        return mail($to, $subject, "", $header);
    }
    
}