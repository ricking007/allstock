<?php

namespace App\controllers;

use Framework\core\Controller;
use App\libs\Email;

class UsuarioController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('usuario');
        $this->view->setTheme('admin');
    }

    public function index() {
        $this->validaPermissaoUsuario(5, 1, true);
        $us = $this->loadModel('usuario');
        $usuarios = $us->getUsuarios();
        $this->view->setRegistros($usuarios, 'usuarios');
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->setJS(array('shared/datatables.min', 'shared/dataTables.bootstrap.min', 'index'));
        $this->view->render('index');
    }

    function get() {
        $data = file_get_contents("php://input");
        $busca = json_decode($data);
        $usu = $this->loadModel('usuario');
        $usu->setNo_nome_completo($busca->q);
        $usuarios = $usu->getUsuarioSearch();
        echo json_encode($usuarios);
    }

    function form($id = 0) {
        $this->validaPermissaoUsuario(5, 3, true);
        if ($id) {
            $us = $this->loadModel('usuario');
            $us->setId_pessoa($id);
            $usuario = $us->getUsuario();
            $this->view->setRegistros($usuario, 'usuario');
        }
        $this->view->setJS(array('usuario'));
        $this->view->render('form');
    }

    function add() {
        $this->restricted();
        $validar = '{"required":["nome","email","tipo","senha","rsenha"],"email":["email"]}';
        $result = $this->validatePost($validar);
        if ($this->getPostParam('senha') != $this->getPostParam('rsenha')) {
            $result['success'] = false;
            $result['message'] = 'Senhas não coincidem';
        } else if (strlen($this->getPostParam('senha')) < 6) {
            $result['success'] = false;
            $result['message'] = 'Senha muito curta, deve conter no mínimo 6 dígitos';
        }
        if ($result['success']) {
            $us = $this->loadModel('usuario');
            $us->setId_pessoa($this->getPostInt('id'));
            $us->setNo_nome_completo($this->getPostString('nome'));
            $us->setDc_email($this->getPostEmail('email'));
            $us->setDc_senha(\App\libs\Util::isMD5($this->getPostParam('senha')));
            $us->setId_pessoa_tipo($this->getPostInt('tipo'));
            $us->setId_usuario_bloqueado($this->getPostInt('bloqueado') ? 1 : NULL);

            $id = $us->set();
            if ($id) {
                if ($this->getPostInt('notificar')) {
                    $destinatario = $us->getDc_email();
                    $destinatario_nome = $us->getNo_nome_completo();
                    $remetente = DEFAULT_REMETENTE_EMAIL;
                    $remetente_nome = DEFAULT_REMETENTE_NOME;
                    $assunto = "Cadastro JS Atacado";
                    $conteudo = "<h1>Olá $destinatario_nome!</h1>";
                    $conteudo .= "<hr/>";
                    $conteudo .= '<p>Seu usuário foi cadastrado no site JS Atacado.<a href="' . BASE_URL . 'login/" title="login"> Para acessar clique aqui</a></p>';
                    $conteudo .= "<p><strong>Seu usuário é:</strong> $destinatario <br/> <strong>Sua Senha é: {$this->getPostParam('senha')}</strong></p>";
                    $conteudo .= "<p><small>OBS: Se o link acima não funcinar copie e cole o seguinte endereço na barra de endereço de seu navegador: " . BASE_URL . "login/</small></p>";
                    $conteudo .= "<p>Equipe JS Atacado</p>";
                    Email::envia($destinatario, $destinatario_nome, $remetente, $remetente_nome, $conteudo, $assunto);
                }
                echo json_encode(array('success' => true, 'message' => 'Usuário cadastrado com sucesso!'));
            }
        } else {
            echo json_encode($result);
        }
    }

    function del($id) {
        if ($id) {
            $us = $this->loadModel('usuario');
            $us->setId_pessoa($id);
            if ($us->delete()) {
                echo json_encode(array("success" => true, "message" => "Usuário excluído com sucesso!"));
            }
        }
    }

}
