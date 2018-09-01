<?php
namespace App\controllers;
use Framework\core\Controller;

class ProdutosController extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->setActive('produtos');
        $this->getGalerias();
    }
    function index(){
        $cat = $this->loadModel('categoria');
        $categorias = $cat->getCategorias();
        
        $prod = $this->loadModel('produtos');
        $prod->setNm_limite(NUM_ITENS_SHOW);
        if($this->getPostInt('offset')){
            $prod->setNm_offset($this->getPostInt('offset'));
        }
        $produtos = $prod->getProdutos();
        $total = $prod->getTotalProdutos();
        
        $this->view->setRegistros($total,'total');
        $this->view->setRegistros($produtos,'produtos');
        $this->view->setRegistros($categorias,'categorias');
        $this->view->setJS(array('index'));
        if($this->getPostInt('ajax') == 1){
            $this->view->renderAjax('ajax');
        } else {
            $this->view->render('index');
        }
    }
    
    function promocoes(){
        $this->view->setActive('promocoes');
        $cat = $this->loadModel('categoria');
        $categorias = $cat->getCategorias();
        
        $prod = $this->loadModel('produtos');
        $produtos = $prod->getProdutosPromocao();
        
        $this->view->setRegistros($produtos,'produtos');
        $this->view->setRegistros($categorias,'categorias');
        $this->view->render('index');
    }
    
    function detalhe($id = 0){
        if($id) {
            $cat = $this->loadModel('categoria');
            $categorias = $cat->getCategorias();

            $prod = $this->loadModel('produtos');
            $prod->setId_produto($id);
            $produto = $prod->getProduto();

            $this->view->setRegistros($categorias,'categorias');
            $this->view->setRegistros($produto,'produto');
            if(!empty($produto) && sizeof($produto)){
                $this->view->setRegistros($produto['id_categoria'],'categoria');
                $foto = $this->loadModel('foto');
                $foto->setId_produto($produto['id_produto']);
                $fotos = $foto->getFotosProduto();
                $this->view->setRegistros($fotos,'fotos');
            }
            $this->view->setJS(array('detalhe'));
            $this->view->render('detalhe');
        } else {
            $this->Redirect('error/404');
        }
        
    }
    function categoria($id = 0){
        if($id){
            $cat = $this->loadModel('categoria');
            $categorias = $cat->getCategorias();
            //Descobre o nome da categoria clicada
            $nome = "PRODUTOS";
            foreach ($categorias as $c){
                if($c['id_categoria'] == $id){
                    $nome = $c['no_categoria'];
                    break;
                }
            }
            $prod = $this->loadModel('produtos');
            $prod->setId_categoria($id);
            $prod->setNm_limite(NUM_ITENS_SHOW);
            if($this->getPostInt('offset')){
                $prod->setNm_offset($this->getPostInt('offset'));
            }
            
            $total = $prod->getTotalProdutos();
            
            $produtos = $prod->getProdutosCategoria();
            
            $this->view->setRegistros($total,'total');
            $this->view->setRegistros($produtos,'produtos');
            $this->view->setRegistros($categorias,'categorias');
            $this->view->setRegistros($id,'categoria');
            $this->view->setRegistros($nome,'titulo');
            $this->view->setJS(array('index'));
            if($this->getPostInt('ajax') == 1){
                $this->view->renderAjax('ajax');
            } else {
                $this->view->render('index');
            }
        }
    }
    function search(){
        $cat = $this->loadModel('categoria');
        $categorias = $cat->getCategorias();
        
        $prod = $this->loadModel('produtos');
        $desc = $this->getGetString('query');
        $desc = explode('-',$desc);
        
        $prod->setCd_produto_cliente(current($desc));
        $prod->setDc_produto(end($desc));
        $produtos = $prod->search();

        $this->view->setRegistros($produtos,'produtos');
        $this->view->setRegistros($categorias,'categorias');
        $this->view->render('index');
    }
    function s(){
        $prod = $this->loadModel('produtos');
        $prod->setDc_produto($this->getGetString('query'));
        $produtos = $prod->search();
        $result = array();
        foreach ($produtos as $p){
            $result[] = $p['cd_produto_cliente'] . ' - ' . $p['dc_produto'];
        }
        echo json_encode($result);
    }
    
}
