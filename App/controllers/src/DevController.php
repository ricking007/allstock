<?php
namespace App\controllers;
use Framework\core\Controller;

class DevController extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->setActive('index');
        $this->getGalerias();
    }
    function index(){
        
        $prod = $this->loadModel('produtos');
        $promocoes = $prod->getProdutosPromocao();
        
        $car = $this->loadModel('carousel');
        $carousel = $car->getCarousel();
        
        $this->view->setRegistros($carousel,'carousel');
        $this->view->setRegistros($promocoes,'promocoes');
        //$this->view->setJS(array('index'));
        $this->view->render('index');
    }
}
