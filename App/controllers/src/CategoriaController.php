<?php
namespace App\controllers;
use Framework\core\Controller;

class CategoriaController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('categoria');
        $this->view->setTheme('admin');
    }
    public function index() {
        $cat = $this->loadModel('categoria');
        $cat->setId_pessoa($this->pessoa());
        $categorias = $cat->getCategorias();
        $this->view->setRegistros(sizeof($categorias),'total');
        $this->view->setRegistros($categorias,'categorias');
        $this->view->setJS(array('shared/datatables.min','shared/dataTables.bootstrap.min','index'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->render('index');
    }
    function form($id = 0){
         if($id){
            $cat = $this->loadModel('categoria');
            $cat->setId_categoria($id);
            $cat->setId_pessoa($this->pessoa());
            $categoria = $cat->getCategoria();
            $this->view->setRegistros($categoria,'categoria');
        }
        $this->view->setJS(array('categoria'));
        $this->view->render('form');
    }
    function add(){
        $validar = '{"required":["nome"]}';
        $result = $this->validatePost($validar);
        if($result['success']){
            $cat = $this->loadModel('categoria');
            $cat->setId_categoria($this->getPostInt('id'));
            $cat->setId_pessoa($this->pessoa());
            $cat->setNo_categoria($this->getPostString('nome'));
            $id = $cat->set();
            if($id){
                echo json_encode(array('success'=>true,'message'=>'Categoria cadastrada com sucesso!','id'=>$id));
            }
        } else {
            echo json_encode($result);
        }
    }
    function del($id){
        if($id){
            $cat = $this->loadModel('categoria');
            $cat->setId_pessoa($this->pessoa());
            $cat->setId_categoria($id);
            if($cat->delete()){
                echo json_encode(array("success"=>true,"message"=>"Categoria excluída com sucesso!"));    
            }
        }
    }
    function get(){
        $cat = $this->loadModel('categoria');
        $cat->setId_pessoa($this->pessoa());
        $categorias = $cat->getCategorias();
        echo json_encode($categorias);
    }
}

