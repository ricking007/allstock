<?php
namespace Framework\core;

use Framework\autoLoader\AutoLoader;
use Framework\core\View;
use Framework\core\Session;
use App\libs\Util;
use App\libs\Functions;
use Exception;

abstract class Controller{
    private $autoLoader;
    protected $view;
    
    public function __construct(){
        $this->autoLoader = AutoLoader::getAutoLoader();
        $this->view = new View($this->autoLoader->request);
    }
    
    abstract public function index();

    /*
     * Carrega o modelo solicitado
     * @return Object
     */
    protected function loadModel($model){
        $model = ucfirst($model) . 'Model';
        $rotaModelo = APP_PATH . 'models' . DS . 'src'. DS. $model . '.php';
        if (is_readable($rotaModelo)) {
            //require_once $rotaModelo;
            //$modelo = new $modelo;            
            $nspace = APP_NSPACE."\\models\\{$model}";
            $modelo = new $nspace();
            return $modelo;
        } else {
            throw new Exception('Model not found');
        }
    }

    /*
     * Retorna o POST da string sem tags html indesejadas
     * @return String
     */
    protected function getPostString($name){
        return filter_input(INPUT_POST,$name,FILTER_SANITIZE_STRING);
    }

    /*
     * Retorna o post do tipo int sem tags e caracteres indesejados
     * @return Int
     */
    protected function getPostInt($name){
        return filter_input(INPUT_POST, $name,FILTER_SANITIZE_NUMBER_INT);
    }
    /*
     * Retorna o post do tipo flot sem tags e caracteres indesejados
     * @return Float
     */
    protected function getPostFloat($name){
        return filter_input(INPUT_POST, $name,FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION);
    }

    /*
     * Retorna o POST conforme nome passado por parametro
     * @return String, Int -> depende do Post
     */
    protected function getPostParam($name){
       return filter_input(INPUT_POST, $name);
    }
    
    /*
     * Retorna o POST conforme nome passado por parametro
     * @return String, Int -> depende do Post
     */
    protected function getPostMultiParam($name){
       return filter_input(INPUT_POST, $name,FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    }
    /*
     * Retorna o GET conforme nome passado por parametro
     * @return String, Int -> depende do GET
     */
    protected function getGetMultiParam($name){
       return filter_input(INPUT_GET, $name,FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    }
    /*
     * Retorna o GET da string sem tags html indesejadas
     * @return String
     */
    protected function getGetString($name){
        return filter_input(INPUT_GET,$name,FILTER_SANITIZE_STRING);
    }
    
    /*
     * Retorna o GET com o num inteiro
     * @return int
     */
    protected function getGetInt($name){
        return filter_input(INPUT_GET,$name,FILTER_SANITIZE_NUMBER_INT);
    }
    
    /*
     * Retorna o GET com o num inteiro
     * @return int
     */
    protected function filterInt($num){
        $num = filter_var($num,FILTER_SANITIZE_NUMBER_INT);
        settype($num,"integer");
        return $num;
    }
    

    /*
     * Verifica se uma string está no formato de hash MD5
     * se não estiver transforma-a
     * @return MD5
     */
    protected function isMD5($hash) {
        return preg_match('/^[a-f0-9]{32}$/', $hash) ? $hash : md5($hash);
    }

    /*
     * Verifica se o email é válido e o retorna, caso contrário retorna false
     * @return String Email
     */
    protected function getPostEmail($email){
        $email = filter_input(INPUT_POST, $email,FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : FALSE;
    }
    protected function isAjax(){
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    /*
     * Redireciona para o caminho desejado
     * Recebe no seguinte formato: controle/método/parametro
     * @return void
     */
    protected function Redirect($location = NULL){
        if ($location) {
            header('Location:' . BASE_URL . $location);
            exit;
        } else {
            header('Location:' . BASE_URL);
            exit;
        }
    }
    protected function getIp() {
        return filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
    }
    /*
     * Retorna o texto traduzido conforme linguagem instanciada
     * @return String
     */
    protected function Text(){
        $autoLoader = AutoLoader::getAutoLoader();
        return $TEXT = $autoLoader->_language;
    }

    /*
     * Seta a linguagem escolhida pelo usuário
     * @return void
     */
    public function setLanguage($lang){
        Session::set('language', $lang);
        //$linkAtual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //$aLang = "setLanguage/$lang";
        //$location = str_replace($aLang,"",$linkAtual);
        $location = $_SERVER['HTTP_REFERER'];
        header("Location: $location");
    }

    /*
     * Retorna o atributo do usuário conforme solicitado
     * @return String, Int -> depende do atributo solicitado
     */
    public function getUser($key){
        return Session::getUser($key);
    }
    public function setUser($key,$val){
        return Session::setUser($key,$val);
    }
    /*
     * Método para validar permissão de acesso
     * @return boolean
     */
    public function validaPermissaoUsuario($id_entidade, $id_permissao, $redirect = false){
        return Session::validaPermissaoUsuario($id_entidade, $id_permissao, $redirect);
    }
    public function restricted(){
        return Session::restricted();
    }
    protected function validatePost($fields){
        $result = array();
        $i = 0;
        $fields = json_decode($fields,true);
        if(!empty($fields['required'])){
            foreach ($fields['required'] as $r){
                $var = $this->getPostParam($r);
                if(empty($var)){
                    $result['errors'][$i]['field'] = $r;
                    $result['errors'][$i]['message'] = $this->Text()->TxCampoObrigatorio();
                    $i++;
                }
                
            }
        }
        if(!empty($fields['multiRequired'])){
            foreach ($fields['multiRequired'] as $r){
                $var = $this->getPostMultiParam($r);
                $e = array();
                 for($j = 0; $j < sizeof($var); $j++){
                    if(empty($var[$j])){
                        $e[$j] = $this->Text()->TxCampoObrigatorio();
                    }
                }
                if(!empty($e)){
                    $result['errors'][$i]['field'] = $r;
                    $result['errors'][$i]['message'] = $e;
                    $i++;
                }
            }
        }
        if(!empty($fields['cpf'])){
            foreach ($fields['cpf'] as $r){
                $var = $this->getPostParam($r);
                if(!empty($var) && !Util::validaCpf($var)){
                    $result['errors'][$i]['field'] = $r;
                    $result['errors'][$i]['message'] = $this->Text()->TxCPFInvalido();
                    $i++;
                }
            }
        }
        if(!empty($fields['email'])){
            foreach ($fields['email'] as $r){
                $var = $this->getPostParam($r);
                if(!empty($var) && !Util::validaEmail($var)){
                    $result['errors'][$i]['field'] = $r;
                    $result['errors'][$i]['message'] = $this->Text()->TxEmailInvalido();
                    $i++;
                }
            }
        }
        if(!empty($fields['data'])){
            foreach ($fields['data'] as $r){
                $var = $this->getPostParam($r);
                if(!empty($var) && !Util::validaData($var)){
                    $result['errors'][$i]['field'] = $r;
                    $result['errors'][$i]['message'] = $this->Text()->TxDataInvalida();
                    $i++;
                }
            }
        }
        if(!empty($fields['file'])){
            foreach ($fields['file'] as $r){
                if(!empty($_FILES[$r['name']])){
                    $var = $_FILES[$r['name']];
                    if($var['size'] > $r['size']){
                       $result['errors'][$i]['field'] = $r['name'];
                       $result['errors'][$i]['message'] = $this->Text()->TxTamanhoMaximo().': '.$r['size']/1024/1024 .'MB';
                       $i++; 
                    //} else if($var['type'] != $r['type']){
                    } else if(!in_array ($var['type'],$r['type'])){
                       $result['errors'][$i]['field'] = $r['name'];
                       $result['errors'][$i]['message'] = $this->Text()->TxTipoDeArquivoInvalido();
                       $i++; 
                    }
                }
                
            }
        }
        if(!empty($fields['captcha'])){
            if(current($fields['captcha']) == 'recaptcha'){
                $captcha = $this->getPostParam('g-recaptcha-response');
                $ip = $this->getIp();
                $json = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY_RECAPTCHA."&response=".$captcha."&remoteip=".$ip);
                $response = json_decode($json);
                if($response->success){
                   $result['captcha']['success'] = true;
                } else {
                   $result['captcha']['success'] = false;
                   $result['captcha']['message'] =  $this->Text()->TxConfirmeQueVoceNaoEUmRobo(); 
                }
            }
            
        } else {
            $result['captcha']['success'] = true;
        }
        if(empty($result['errors']) && $result['captcha']['success']){
            $result['success'] = true;
        } else {
            $result['success'] = false;
            $result['message'] = $this->Text()->TxOcorremErrosDeValidacao();
        }
        return $result;
    }
    protected function getGalerias(){
        $ga = $this->loadModel('galeria');
        $ga->setNm_limite(6);
        $galerias = $ga->getGalerias();
        $this->view->setRegistros($galerias,'galeriasFooter');
    }
    //setar pessoa logada
    function pessoa() {
        return $this->getUser('id_pessoa');
    }
    //setar tipo de usuário
   
    
}