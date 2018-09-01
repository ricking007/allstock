<?php

namespace App\controllers;

use Framework\core\Controller;

class ContagemController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('contagem');
        $this->view->setTheme('admin');
    }

    public function index() {
        $con = $this->loadModel('contagem');
        $con->setId_pessoa($this->pessoa());
        $contagens = $con->getContagens();
        $this->view->setRegistros(sizeof($contagens), 'total');
        $this->view->setRegistros($contagens, 'contagens');
        $this->view->setJS(array('shared/datatables.min', 'shared/dataTables.bootstrap.min', 'index'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->render('index');
    }

    public function view($id) {
        if ($id) {
            $con = $this->loadModel('contagem');
            $con->setId_pessoa($this->pessoa());
            $con->setId_contagem($id);
            $contagem = $con->getContagem();
            $produto = $con->getContagemProduto();
            $produtos = $con->getContagemProdutos();
           
            $this->view->setRegistros($contagem, 'contagem');
            $this->view->setRegistros($produto, 'produto');
            $this->view->setRegistros($produtos, 'produtos');
            $this->view->setRegistros(sizeof($produtos), 'total');
            $this->view->setJS(array('shared/datatables.min', 'shared/dataTables.bootstrap.min','canvasjs', 'view'));
            $this->view->setCSS(array('shared/dataTables.bootstrap.min','canvas'));
            $this->view->render('view');
        }
        $this->Redirect('contagem');
    }

    function produto($id) {
        if ($id) {
            $con = $this->loadModel('contagem');
            $con->setId_contagem_produto($id);
            $produto = $con->getProduto();
           
            $this->view->setRegistros($produto, 'produto');
            $this->view->setJS(array('canvasjs'));
            $this->view->setCSS(array('canvas'));
            $this->view->render('produto');
        }
        $this->Redirect('contagem');
    }

}
