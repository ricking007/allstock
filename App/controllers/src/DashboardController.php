<?php
namespace App\controllers;
use Framework\core\Controller;

class DashboardController extends Controller {

    function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('dashboard');
        $this->view->setTheme('admin');
    }
    function index(){
        $dash = $this->loadModel('dashboard');
        $dados = $dash->getDados();
        $this->view->setJS(array('shared/Chart','dashboard'));
        if(!empty($dados)){
            foreach ($dados as $d){
                $this->view->setRegistros($d['qtd'],$d['no_entidade']);  
            }
        }
        $this->view->render('index');
    }
    function recents(){
        $dash = $this->loadModel('dashboard');
        $recentes = $dash->getPedidosUltMeses();
        $meses = array(1=>'Jan','Fev','Mar','Abr','Mai','Jun','Jul',
                            'Ago','Set','Out','Nov','Dez');
        $response = array();
        
        if(!empty($recentes) && sizeof($recentes) > 1){
            foreach ($recentes as $r){
                $response['labels'][] = $meses[$r['mes']].'/'.$r['ano'];
                $response['data'][] = $r['qtd'];
            }
        } else {
            $response = array('labels'=>false,'data'=>0);
        }
        echo json_encode($response);
    }
    function brands(){
        $dash = $this->loadModel('dashboard');
        $marcas = $dash->getQtMarca();
        $response = array();
        if(!empty($marcas)){
            
            foreach ($marcas as $m){
                $response['data'][] = $m['qtd'];
                $response['label'][] = $m['no_marca'];
            }
        } else {
            $response = array('success'=>false);
        }
        echo json_encode($response);
    }
    function types(){
        $dash = $this->loadModel('dashboard');
        $tipos = $dash->getQtCategoria();
        $response = array();
        if(!empty($tipos)){
            $i = 0;
            $total = 0;
            foreach ($tipos as $t){
                $total += $t['qtd'];
            }
            foreach ($tipos as $t){
                $response[$i]['value'] = round($t['qtd'] * 100 / $total,2);
                $response[$i]['color'] = 'rgba('.  implode(',', $this->getColor($i)).',1)';
                $response[$i]['highlight'] = 'rgba('.  implode(',', $this->getColor($i)).',.8)';
                $response[$i]['label'] = $t['no_categoria'];
                $i++;
            }
        } else {
            $response = array('success'=>false);
        }
        echo json_encode($response);
    }
    private function getColor($num) {
        $hash = md5('color' . $num); // modify 'color' to get a different palette
        $a = array(hexdec(substr($hash, 0, 2)), // r
                   hexdec(substr($hash, 2, 2)), // g
                   hexdec(substr($hash, 4, 2))); //b;
        $cores = array(
            array(93, 165, 218),
            array(250, 164, 58),array(96, 189, 104),
            array(241, 124, 176),array(178, 145, 47),
            array(178, 118, 178),array(222, 207, 63),
            array(241, 88, 84),array(77,77,77)
            );
        return !empty($cores[$num]) ? $cores[$num] : $a;
    }
}