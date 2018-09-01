<?php
namespace App\controllers;
use Framework\core\Controller;

class MarcaController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('marca');
        $this->view->setTheme('admin');
    }
    public function index() {
        
        $mar = $this->loadModel('marca');
        $mar->setId_pessoa($this->pessoa());
        $marcas = $mar->getMarcas();
        $this->view->setRegistros($marcas,'marcas');
        $this->view->setRegistros(sizeof($marcas),'total');
        $this->view->setJS(array('shared/datatables.min','shared/dataTables.bootstrap.min','index'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->render('index');
    }
    function form($id = 0){
         if($id){
            $mar = $this->loadModel('marca');
            $mar->setId_marca($id);
            $mar->setId_pessoa($this->pessoa());
            $marca = $mar->getMarca();
            $this->view->setRegistros($marca,'marca');
        }
        $this->view->setJS(array('marca'));
        $this->view->render('form');
    }
    function add(){
        $validar = '{"required":["nome"]}';
        $result = $this->validatePost($validar);
        if($result['success']){
            $mar = $this->loadModel('marca');
            $mar->setId_marca($this->getPostInt('id'));
            $mar->setId_pessoa($this->pessoa());
            $mar->setNo_marca($this->getPostString('nome'));
            $id = $mar->set();
            if($id){
                echo json_encode(array('success'=>true,'message'=>'Marca cadastrada com sucesso!','id'=>$id));
            }
        } else {
            echo json_encode($result);
        }
    }
    function del($id){
        if($id){
            $mar = $this->loadModel('marca');
            $mar->setId_marca($id);
            $mar->setId_pessoa($this->pessoa());
            if($mar->delete()){
                echo json_encode(array("success"=>true,"message"=>"Marca excluída com sucesso!"));    
            }
        }
    }
    
}

