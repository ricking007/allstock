<?php

namespace App\controllers;

use Framework\core\Controller;
use App\libs\Util;

class CaixaController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('caixa');
        $this->view->setTheme('caixa');
    }

    public function index() {
        $this->view->setJS(array('shared/datatables.min', 'shared/dataTables.bootstrap.min', 'index', 'default/default', 'default/typeahead'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->render('index');
    }
    
    function telefone($telefone){
        if(Util::validaTelefone($telefone)){
           echo $telefone;
           exit;
        }
    }

}
