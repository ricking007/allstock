<?php
namespace App\controllers;
use Framework\core\Controller;

class SobreController extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->setActive('sobre');
        $this->getGalerias();
    }
    function index(){
        $sob = $this->loadModel('sobre');
        $sob->get();
        $this->view->setRegistros($sob->getDc_sobre(),'sobre');
        $this->view->render('index');
    }
    function form(){
        $this->restricted();
        $this->view->setTheme('admin');
        
        $sob = $this->loadModel('sobre');
        $sob->get();
        $this->view->setCSS(array('shared/summernote'));
        $this->view->setJS(array('shared/summernote.min','shared/summernote-pt-BR','form'));
        $this->view->setRegistros($sob->getDc_sobre(),'sobre');
        $this->view->render('form');
    }
    function edit(){
        $this->restricted();
        $validar = '{"required":["sobre"]}';
        $result = $this->validatePost($validar);
        if($result['success']){
            $sob = $this->loadModel('sobre');
            $sob->setDc_sobre($this->getPostParam('sobre'));
            if($sob->updDcSobre()){
                echo json_encode(array("success"=>true,"message"=>"Texto salvo com sucesso!"));
            } else {
                echo json_encode(array("success"=>false,"message"=>"Texto não foi alterado!"));
            }
        } else {
            echo json_encode($result);
        }
        
    }
    
}
