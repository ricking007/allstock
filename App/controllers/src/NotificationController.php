<?php
namespace App\controllers;
use Framework\core\Controller;
class NotificationController extends Controller {

    function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setTheme('admin');
    }
    function index(){
        $not = $this->loadModel('notification');
        $not->setId_pessoa($this->getUser('id_pessoa'));
        $notificacoes = $not->get();
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->setJS(array('shared/datatables.min','shared/dataTables.bootstrap.min','index'));
        $this->view->setRegistros($notificacoes,'notificacoes');
        $this->view->render('index');
    }
    function get($id = 0){
        $not = $this->loadModel('notification');
        if($id) $not->setId_status($id);
        $not->setId_pessoa($this->getUser('id_pessoa'));
        echo json_encode($not->get());
    }
    function read($id){
        $not = $this->loadModel('notification');
        $not->setId_notificacao($id);
        $not->setId_pessoa($this->getUser('id_pessoa'));
        $notification = $not->getNotification();
        //echo"<pre>";print_r($notification);exit;
        $this->view->setRegistros($notification,'notification');
        $this->view->setJS(array('notification'));
        $this->view->render('notification');
    }
    function send(){
        $fields = '{"required":["email","assunto","mensagem","not","pedido"],"email":["email"],'
                . '"file":[{"name":"file","size":2097152,"type":"text/xml"}],"multiRequired":["file"]}';
        $result = $this->validatePost($fields);
        if($result['success']){
            $file = $_FILES['file'];
            $res = \App\libs\Email::enviaAnexo($this->getPostParam('email'), 
                    utf8_decode($this->getPostParam('assunto')), 
                    $this->getPostParam('mensagem'), 
                    DEFAULT_REMETENTE_EMAIL,
                    $file);
            if($res){
                echo json_encode(array('success'=>true,'message'=>'Arquivo enviado com sucesso'));
                $not = $this->loadModel('notification');
                $not->setId_notificacao($this->getPostInt('not'));
                $not->complete();
                move_uploaded_file($file['tmp_name'],DIR_XML.$this->getPostInt('pedido').'.xml');
                
            } else {
                echo json_encode(array('success'=>false,'message'=>'Ocorreu um erro ao enviar o arquivo'));
            }
        } else {
            echo json_encode($result);
        }
    }
    
    function download($id){
        if(filter_var($id,FILTER_VALIDATE_INT)){
                
            $f = DIR_XML.$id.'.xml';
            if(file_exists($f)){
                header('Content-Type: text/xml');
                header('Content-Disposition: attachment; filename='.'pedido_'.$id.'.xml');
                header('Pragma: no-cache');
                readfile($f);
            }
        }
    }
    
    function complete($id){
        if(filter_var($id,FILTER_VALIDATE_INT)){
            $not = $this->loadModel('notification');
            $not->setId_notificacao($id);
            $not->complete();
            $this->Redirect('notification');
        }
    }

}