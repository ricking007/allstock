<?php
namespace App\controllers;

use Framework\core\Controller;
use Framework\core\Session;
use App\libs\Bcrypt;
use App\libs\Email;

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->view->setTheme('login');
    }
    /*
     * Método para renderizar a página principal do login
     * @return void
     */
    public function index(){
        
        $this->view->render('index');
    }
    /*
     * Método para renderizar a página de recuperar senha
     * @return void
     */
    public function forgot(){
        
        //Se não houver post, renderiza o form de recuperação de senha
        if($this->getPostParam('login')){
            $email = $this->getPostEmail('login'); 
            $chave = $this->geraChave($email, $email);
            $login = $this->loadModel('login');
            $login->setDc_email($email);
            $login->setDc_chave($chave);
            
            $login->setDc_usuario($email);
            $pes =  $login->login();
            
            $result = $login->setChaveRecuperacaoSenhaEmail();
            if($result){
                $this->enviaChave($pes['no_nome_completo'], $email, $chave);
                $this->view->setMsg('Um e-mail contendo informações para recuperação de senha'
                                    . ' foi enviado. Verifique a caixa de entrada'
                                    . ' e lixo eletrônico de seu e-mail.','success');    
                $this->view->render('recuperarSenhaForm'); 
            } else {
                $this->view->setMsg('E-mail não localizado.','danger');    
                $this->view->render('recuperarSenhaForm'); 
            }
            exit;
            
        } else if ($this->getPostParam('login')) {
            $this->view->setMsg('E-mail não localizado.','danger');    
            $this->view->render('recuperarSenhaForm'); 
        } else {
            $this->view->render('recuperarSenhaForm'); 
        }
    }
    /*
     * Método para efetuar o login
     * @return void
     */
    public function loginDo($usuario = 0,$senha = 0){
        
        $login = $this->loadModel('login');
        if($usuario && $senha) {
            $usuario = strtolower($usuario);
            $senha = $this->isMD5($senha);
        } else {
            $usuario = strtolower($this->getPostString('login'));
            $senha = $this->isMD5($this->getPostString('senha'));
        }
        $login->setDc_usuario($usuario);
        
        $pes = $login->login();
        //print_r($pes);exit;
        
        if(!empty($pes)){
            //Verifica se o usuário não está bloqueado
            $this->checkUsuarioBloqueado($pes['id_usuario_bloqueado']);

            $login->setId_pessoa($pes['id_pessoa']);
            
            if(Bcrypt::check($senha,$pes['dc_senha'])){
                $pagina = $this->getHomePage($pes['id_pessoa_tipo']);
                if($pagina){
                    $login->atualizaUltimoAcesso(); // atualiza a data do acesso e zera tentativas
                    $this->carregaUsuarioSessao($pes); // Carrega a pessoa na sessão e redireciona
                    $this->Redirect($pagina);
                } else {
                    $this->view->setMsg('Tipo de usuário não encontrado','danger');
                    $this->Redirect('login');
                }

            } else {
                if($pes['qt_tentativa_acesso'] >= QT_TENTATIVAS_LOGIN && !$pes['id_usuario_bloqueado']){
                    $this->bloqueia($pes['no_nome_completo'],$pes['dc_login'],$pes['dc_email']);
                    $this->view->setMsg('Sua conta foi bloqueada devido excesso '
                                        . 'de tentativas de acesso. '
                                        . 'Verifique seu e-mail para obter informações e '
                                        . 'recuperar seu acesso.','danger');
                    $this->Redirect('login');
                } else {
                    $login->regTentativaLogin();
                }
                $this->view->setMsg('Usuário e/ou senha não encontrado','danger');
                $this->Redirect('login');
            }
        } else {
            $this->view->setMsg('Usuário e/ou senha não encontrado','danger');
            $this->Redirect('login');
        }
    }
    
    /*
     * Bloqueia um usuário e envia uma chave de recuperação para o email
     * cadastrado
     * @return void
     */
    private function bloqueia($nome,$dc_usuario,$dc_email){
        $login = $this->loadModel('login');
        $login->setDc_usuario($dc_usuario);
        $login->setDc_email($dc_email);
        $login->bloqueia();
        $chave = $this->geraChave($dc_usuario,$dc_email);
        $login->setChaveRecuperacaoSenha($chave);
        $this->enviaChave($nome,$dc_email, $chave);
    }
    /*
     * Verifica se o usuário está bloqueado e impede login, adiciona um atraso
     * de x segundos para cada tentativa, retardando um possível ataque de
     * brute force
     * @return void
     */
    private function checkUsuarioBloqueado($id_bloqueado){
        if($id_bloqueado){
            sleep(SLEEP_BRUTE_FORCE);
            $this->view->setMsg('Esta conta encontra-se bloqueada, por suspeita '
                                . 'de tentativa de invasão, se você for o proprietário'
                                . ' desta conta <a href="login/forgot" title="Esqueci minha senha">clique aqui</a>, '
                                . ' ou entre em contato com o administrador do sistema.','danger'); 
            $this->Redirect('login');
        }
    }
    /*
     * Gera uma chave de recuperação de senha
     * @return String Hash MD5
     */
    private function geraChave($dc_usuario,$dc_email) {
        return md5(md5($dc_usuario.uniqid().$dc_email) . time());
    }
    /*
     * Envia a chave de recuperação de senha para o email cadastrado
     * @return void
     */
    private function enviaChave($nome,$email,$chave){
        $conteudo = "<h3>Olá $nome!</h3>"
                . "<p>Para recuperar sua senha utilize o link abaixo:".
                                "</p>".BASE_URL."login/recovery/".$chave;
        Email::envia($email, 
                    $nome, 
                    DEFAULT_REMETENTE_EMAIL, 
                    DEFAULT_REMETENTE_NOME, 
                    $conteudo, 
                    'Recuperação de senha'
                    );
    
    }
    /*
     * Se o login ocorreu normalmente, carrega o usuário na sessão,
     * carrega também as permissões do usuário na sessão
     * @return void
     */
    public function carregaUsuarioSessao($pessoa){
        unset($pessoa['dc_senha']);
        $nomeCompleto = explode(" ", $pessoa['no_nome_completo']);
        $pessoa['no_nome'] = current($nomeCompleto);
        $hash = hash('sha512',
                $pessoa['id_pessoa'].
                $_SERVER['HTTP_USER_AGENT'].
                $_SERVER['REMOTE_ADDR']);
        $login = $this->loadModel('login');
        $login->setId_pessoa_tipo($pessoa['id_pessoa_tipo']);
        $permissoes = $login->getPermissoesUsuario();
        Session::set('login_hash_str',$hash);
        Session::set('login_perm_user', serialize($permissoes));
        Session::set('login_auth_user', serialize($pessoa));
    }
    /*
     * Método para recuperar Senha
     * @return void
     */
    public function recovery($chave = ''){
        $login = $this->loadModel('login');
        $login->setDc_chave($chave);
        $pessoa = $login->getPessoaChaveRecuperacao();
        
        if(!empty($pessoa) && !$this->getPostParam('senha')){
            if($this->getPostInt('recovery')){
                $this->view->setMsg("Senha não pode ser vazia",'danger');
            }
            $this->view->render('redefinirSenhaForm');
        } else if($this->getPostParam('senha')){
            $senha = $this->isMD5($this->getPostString('senha'));
            $rtsenha = $this->isMD5($this->getPostString('rtsenha'));
            if($senha === $rtsenha){
                $login->setDc_senha(Bcrypt::hash($senha));
                $login->setDc_email($pessoa['dc_email']);
                $login->setSenhaEmail() ? $this->view->setMsg('Senha definida com sucesso, '
                                                              . 'faça login com sua nova senha.','success') : $this->view->setMsg('Erro ao definir senha','danger');
                $this->Redirect('login');
            } else {
                $this->view->setMsg('Senhas não coincidem.','danger');
                $this->view->render('redefinirSenhaForm');
            }
        } else {
            $this->view->setMsg('Chave de recuperação de senha inválida.','danger');
            $this->Redirect('login');
        }
        
        
    }
    
    /*
     * Faz logout e apaga todos os dados da sessão
     * @return void
     */
    public function logout() {
        Session::logout();
    }
    /*
     * Retorna a página principal para o tipo de pessoa logada
     * @return String
     */
    private function getHomePage($id_pessoa_tipo){
        switch ($id_pessoa_tipo){
            case '1'  : // Administrador
                $pagina = "dashboard";
                break;
            case '2'  : // Usuário
                $pagina = "caixa";
                break;
            default:
                $pagina = FALSE;
        }
        return $pagina;
    }
}

?>
