<?php
namespace App\controllers;
use Framework\core\Controller;

class ContatoController extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->setActive('contato');
        $this->getGalerias();
    }
    function index(){
        $this->view->setJS(array('shared/jasny-bootstrap.min','contato'));
        $this->view->render('index');
    }
    function send(){
        $valida = '{"required":["nome","email","mensagem"],"email":["email"]}';
        $result = $this->validatePost($valida);
        if($result['success']){
            $nome = $this->getPostParam('nome');
            $email = $this->getPostEmail('email');
            $msg = $this->getPostParam('mensagem');
            $conteudo = "<h1>Você recebeu um novo contato através do site</h1>";
            $conteudo .= "<p><strong>Nome:</strong> $nome</p>";
            $conteudo .= "<p><strong>Email:</strong> $email</p>";
            $conteudo .= "<hr/>";
            $conteudo .= "<p><strong>Mensagem:</strong></p>";
            $conteudo .= "<p>$msg</p>";
            $res = \App\libs\Email::envia(EMAIL_CONTATO, NOME_CONTATO, 
                    $email, $nome, 
                    $conteudo, ASSUNTO_CONTATO);
                
            if($res){
                $conteudo .= "<p><strong>Um email foi enviado para: ".EMAIL_CONTATO."</strong></p>";
                $not = $this->loadModel('notification');
                $not->setDc_titulo(ASSUNTO_CONTATO);
                $not->setDc_mensagem($conteudo);
                $not->set();
                echo json_encode(array('success'=>true,'message'=>'Sua mensagem foi enviada com sucesso!'));
            }
        } else {
            echo json_encode($result);
        }
    }
    function curriculum(){
        $valida = '{"required":["apresentacao"],"multiRequired":["arquivo"],'
                . '"file":[{"name":"arquivo","size":2097152,'
                . '"type":["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document",'
                . '"application/msword"]}]}';
        $result = $this->validatePost($valida);
        if($result['success']){
            $msg = $this->getPostParam('apresentacao');
            $conteudo = "<h1>Você recebeu um novo curriculum através do site</h1>";
            $conteudo .= "<p><strong>Veja abaixo a mensagem de apresentação do candidato</strong></p>";
            $conteudo .= "<hr/>";
            $conteudo .= "<p>$msg</p>";
            $res = \App\libs\Email::enviaAnexo(EMAIL_CONTATO, 'Curriculum',$conteudo,
                    DEFAULT_REMETENTE_EMAIL,$_FILES['arquivo']);
               
            if($res){
                $conteudo .= "<p><strong>Um email foi enviado para: ".EMAIL_CONTATO."</strong></p>";
                $not = $this->loadModel('notification');
                $not->setDc_titulo('Novo Curriculum');
                $not->setDc_mensagem($conteudo);
                $not->set();
                echo json_encode(array('success'=>true,'message'=>'Sua mensagem foi enviada com sucesso!'));
            }
        } else {
            echo json_encode($result);
        }
    }
}
