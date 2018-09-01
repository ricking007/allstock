<?php
namespace App;

define('ORGANIZACAO_NOME','All Stock');
//define('BASE_URL', 'http://localhost:81/jsatacado.com.br/public/'); //para redirecionar

//Verifica qual o protocolo
$protocol = $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST']; // pega o dominio
$domainName = rtrim($domainName,"/"); // garante que o dominio nao veio com barra no final
$domainName .= "/"; // adiciona uma barra no fim
//define('BASE_URL',$protocol.$domainName);
define('BASE_URL','http://localhost/allstock/public/');
//define('BASE_URL','http://intimusvirtual.com.br/public/');


define('APP_URL', 'C:\\xampp\\htdocs\\allstock\\App'); // para renderizar views
//define('APP_URL', '/var/www/intimusvirtual.com.br/App'); // para renderizar views
define('APP_NSPACE', 'App'); // para boostrap

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT','3306');
define('DB_NAME', 'allstock');
define('DB_USER', 'root');
define('DB_PASS', ''); 
//define('DB_PASS', 'lJPf5Pep9h'); 

define('DEFAULT_PAGE_TITLE', 'All Stock'); //máximo 60 caracteres
define('DEFAULT_CONTROLLER', 'Index');
define('DEFAULT_LANGUAGE', 'ptBR');
define('DEFAULT_TEMA', 'default');
define('DB_CHAR', 'utf8');
define('SECURE',false);
define('SLEEP_BRUTE_FORCE',3);
define('QT_TENTATIVAS_LOGIN',6);

define ('DEFAULT_REMETENTE_EMAIL','noreply');
define ('DEFAULT_REMETENTE_NOME','All Stock');

define ('DEFAULT_CEP','40060001');

//pagseguro
define('DEFINE_EMAIL','ricardorick45@hotmail.com');
define('DEFINE_TOKEN','748DC20CA18B439ABEDC23E49342F92A');

define ('EMAIL_CONTATO','ricardorick45@hotmail.com');
define ('NOME_CONTATO','All Stock');
define ('ASSUNTO_CONTATO','Form de contato do site All Stock');

define ('DIR_XML','C:\\xampp\\htdocs\\allstock\\Files\\xml\\');
//define ('DIR_XML','/var/www/intimusvirtual.com.br/Files/xml/');
define('NUM_ITENS_GRID',12);
define('NUM_ITENS_SHOW',12);
