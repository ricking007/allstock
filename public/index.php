<?php
//phpinfo();
//exit("Em breve, aguarde...");
ini_set('display_errors', 1);
ini_set('date.timezone', 'America/Sao_Paulo');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__DIR__)) . DS);
define('APP_PATH', ROOT . 'App' . DS);
try{
    require_once APP_PATH . 'config.php';
    require_once APP_PATH . 'autoload.php';
    Framework\core\Session::init();
    Framework\core\Bootstrap::run($autoLoader->request);
} catch (\Exception $e) {
    echo 'index.php: ' . $e->getMessage() ; 
    //header('location:' . BASE_URL . "error"); exit;
}
?>
