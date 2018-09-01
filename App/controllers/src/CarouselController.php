<?php
namespace App\controllers;
use Framework\core\Controller;

class CarouselController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('slides');
        $this->view->setTheme('admin');
    }
    public function index() {
        $car = $this->loadModel('carousel');
        $carousel = $car->getCarousel();
        $this->view->setRegistros($carousel,'carousel');
        $this->view->setCSS(array('shared/summernote'));
        $this->view->setJS(array('shared/jquery.cropit','shared/summernote.min','shared/summernote-pt-BR','index'));
        $this->view->render('index');
    }
    
    function add(){
        if($this->getPostParam('imagem')){
            // Recuperando imagem em base64
            // Exemplo: data:image/png;base64,AAAFBfj42Pj4
            $imagem = $this->getPostParam('imagem');
            // Separando tipo dos dados da imagem
            // $tipo: data:image/png
            // $dados: base64,AAAFBfj42Pj4
            list($tipo, $dados) = explode(';', $imagem);
            // Isolando apenas o tipo da imagem
            // $tipo: image/png
            list(, $tipo) = explode(':', $tipo);
            // Isolando apenas os dados da imagem
            // $dados: AAAFBfj42Pj4
            list(, $dados) = explode(',', $dados);
            // Convertendo base64 para imagem
            $dados = base64_decode($dados);
            $car = $this->loadModel('carousel');
            $car->setDc_imagem('jpg');
            $car->setId_cadastrado_por($this->getUser('id_pessoa'));
            $car->setCarousel();
            
            $nome = $car->getId_carousel();
            if($nome){
                // Salvando imagem em disco
                file_put_contents("img/carousel/{$nome}.jpg", $dados);
                echo json_encode(array('success'=>true,'message'=>'Imagem salva com sucesso','id'=>$nome));exit;
            } else {
                echo json_encode(array('success'=>false,'message'=>'Erro ao salvar imagem'));exit;
            }
        } else {
            echo json_encode(array('success'=>false,'message'=>'Erro ao salvar imagem'));exit;
        }
    }
    function del($img){
        if($img){
            $dados = explode('.',$img);
            $car = $this->loadModel('carousel');
            $car->setId_carousel($dados[0]);
            if($car->delete()){
                @unlink("img/carousel/$img");
                echo json_encode(array("success"=>true,"message"=>"Imagem excluída com sucesso!"));    
            }
        }
    }
    function getconfig($id){
        $cap = $this->loadModel('carousel');
        $cap->setId_carousel($id);
        $carousel = $cap->getConfig();
        echo json_encode($carousel);
    }
    function edit(){
        //print_r($_POST);exit;
        if($this->getPostInt('id_carousel_edit')){
            $car = $this->loadModel('carousel');
            $car->setId_carousel($this->getPostInt('id_carousel_edit'));
            $car->setDc_capiton($this->getPostParam('caption'));
            $car->setDc_link($this->getPostParam('link'));
            $car->updCarousel();
        }
        $this->Redirect('carousel');
    }
}

