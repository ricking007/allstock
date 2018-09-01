<?php
namespace App\controllers;
use Framework\core\Controller;
class PerfilController extends Controller {

    function __construct() {
        parent::__construct();
        $this->restricted();
        
    }
    function index() {
        $this->view->setTheme('admin');
        $this->view->setJS(array('perfil'));
        $this->view->render('index');
    }
    function user() {
        $this->view->setTheme('caixa');
        $this->view->setJS(array('perfil'));
        $this->view->render('user');
    }
    function setTema($tema){
        $per = $this->loadModel('perfil');
        $per->setDc_tema($tema);
        $per->setId_pessoa($this->getUser('id_pessoa'));
        if($per->setTema()){
            $this->setUser('dc_tema', $tema);
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('success'=>false));
        }
    }
    function setImg($img){
        $per = $this->loadModel('perfil');
        $per->setDc_img_perfil($img);
        $per->setId_pessoa($this->getUser('id_pessoa'));
        if($per->setImg()){
            $this->setUser('dc_img_perfil', $img);
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('success'=>false));
        }
    }
    function password(){
        $validar = '{"required":["senhaa","senha","rsenha"]}';
        $result = $this->validatePost($validar);
        
        $us = $this->loadModel('perfil');
        $us->setId_pessoa($this->getUser('id_pessoa'));
        $senhaBD = $us->getPass();
        //print_r($senhaBD);exit;
        $senhaa = $this->getPostParam('senhaa');
        
        if($result['success']){
            if(!\App\libs\Bcrypt::check(\App\libs\Util::isMD5($senhaa), $senhaBD['dc_senha'])){
                $result['success'] = false;
                $result['message'] = 'Senha atual não confere';
                $result['errors'][] = 'senhaa';
            } else if($this->getPostParam('senha') != $this->getPostParam('rsenha')){
                $result['success'] = false;
                $result['message'] = 'Senhas não conferem';
                $result['errors'][] = 'rsenha';
            } else if(strlen ($this->getPostParam('senha')) < 6 ){
                $result['success'] = false;
                $result['message'] = 'Senha muito curta, deve conter no mínimo 6 digitos';
                $result['errors'][] = 'senha';
            } else {
                $us->setDc_senha(\App\libs\Util::isMD5($this->getPostParam('senha')));
                if($us->updSenha()){
                    echo json_encode(array("success" => true, "message" => "Senha alterada com sucesso"));
                    exit;
                }
            }
            echo json_encode($result);exit;
        } else {
            echo json_encode($result);exit;
        }
    }

}

