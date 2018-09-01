<?php

namespace App\controllers;

use Framework\core\Controller;

class EmbalagemController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('embalagem');
        $this->view->setTheme('admin');
    }

    public function index() {

        $emb = $this->loadModel('embalagem');
        $emb->setId_pessoa($this->pessoa());
        $embalagens = $emb->getEmbalagens();
        $this->view->setRegistros($embalagens, 'embalagens');
        $this->view->setRegistros(sizeof($embalagens), 'total');
        $this->view->setJS(array('shared/datatables.min', 'shared/dataTables.bootstrap.min', 'index'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->render('index');
    }

    function form($id = 0) {
        if ($id) {
            $emb = $this->loadModel('embalagem');
            $emb->setId_embalagem($id);
            $emb->setId_pessoa($this->pessoa());
            $embalagem = $emb->getEmbalagem();
            $this->view->setRegistros($embalagem, 'embalagem');
        }
        $this->view->setJS(array('embalagem'));
        $this->view->render('form');
    }

    function add() {
        $validar = '{"required":["nome"]}';
        $result = $this->validatePost($validar);
        if ($result['success']) {
            $emb = $this->loadModel('embalagem');
            $emb->setId_embalagem($this->getPostInt('id'));
            $emb->setId_pessoa($this->pessoa());
            $emb->setNo_embalagem($this->getPostString('nome'));
            $id = $emb->set();
            if ($id) {
                echo json_encode(array('success' => true, 'message' => 'Embalagem cadastrada com sucesso!', 'id' => $id));
            }
        } else {
            echo json_encode($result);
        }
    }

    function del($id) {
        if ($id) {
            $emb = $this->loadModel('embalagem');
            $emb->setId_embalagem($id);
            $emb->setId_pessoa($this->pessoa());
            if ($emb->delete()) {
                echo json_encode(array("success" => true, "message" => "Embalagem excluída com sucesso!"));
            }
        }
    }

}
