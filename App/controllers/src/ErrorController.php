<?php
namespace App\controllers;

use Framework\core\Controller;

class ErrorController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->view->setTheme('login');
    }
    public function index(){
        $this->view->render('index');
    }
    public function acessoNegado(){
        $this->view->render('403');
    }
    
}
?>
