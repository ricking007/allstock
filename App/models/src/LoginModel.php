<?php
namespace App\models;
use Framework\core\Model;

class LoginModel extends Model
{
    private $dc_usuario, 
            $dc_senha,
            $id_pessoa,
            $dc_email,
            $dc_chave,
            $id_pessoa_tipo;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getDc_usuario() {
        return $this->dc_usuario;
    }

    public function getDc_senha() {
        return $this->dc_senha;
    }

    public function setDc_usuario($dc_usuario) {
        $this->dc_usuario = $dc_usuario;
    }

    public function setDc_senha($dc_senha) {
        $this->dc_senha = $dc_senha;
    }
   
    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function setId_pessoa($cd_pessoa) {
        $this->id_pessoa = $cd_pessoa;
    }
    public function getDc_email() {
        return $this->dc_email;
    }

    public function setDc_email($dc_email) {
        if(filter_var($dc_email,FILTER_VALIDATE_EMAIL)){
            $this->dc_email = $dc_email;
        }
    }
    public function getDc_chave() {
        return $this->dc_chave;
    }

    public function setDc_chave($dc_chave) {
        $this->dc_chave = $dc_chave;
    }
    
    public function getId_pessoa_tipo() {
        return $this->id_pessoa_tipo;
    }

    public function setId_pessoa_tipo($id_pessoa_tipo) {
        $this->id_pessoa_tipo = $id_pessoa_tipo;
    }
        
    /*
     * Método para selecionar o usuário
     * @return Array
     */
    public function login(){
        $sql = "SELECT p.*,pe.dc_img_perfil,pe.dc_tema FROM pessoa p LEFT JOIN perfil pe"
                . " ON p.id_pessoa = pe.id_pessoa WHERE p.dc_email = ?;";
        $params = array($this->getDc_usuario());
        $res = $this->query($sql,$params);
        return $res->fetch();
    }

    /*
     * Registra tentativa de login
     * @return void
     */
    public function regTentativaLogin() {
        $sql = "UPDATE pessoa SET qt_tentativa_acesso = qt_tentativa_acesso+1 WHERE dc_email = ?";
        $params = array($this->getDc_usuario());
        $this->query($sql,$params);
    }

    /*
     * Bloqueia um usuário com tentativas maior do que QT_TENTATIVAS_LOGIN
     * @return void
     */
    public function bloqueia() {
        $sql = "UPDATE pessoa SET id_usuario_bloqueado = 1 WHERE dc_email = ?";
        $params = array($this->getDc_email());
        $this->query($sql,$params);
    }

    /*
     * Grava uma chave de recuperação de senha
     * @return void
     */
    public function setChaveRecuperacaoSenha($chave) {
        $sql = "UPDATE pessoa SET dc_chave_recuperacao_senha = ? WHERE dc_email = ?";
        $params = array($chave,$this->getDc_usuario());
        $this->query($sql,$params);
    }

    /*
     * Método que atualiza a data do último acesso do usuário e zera as 
     * tentativas de login
     * @return void
     */
    public function atualizaUltimoAcesso() {
        $sql = "UPDATE pessoa SET dt_ultimo_acesso = NOW(),"
             . "qt_tentativa_acesso = 0 WHERE id_pessoa = ?;";
        $params = array($this->getId_pessoa());
        $this->query($sql,$params);
    }

    /*
     * Método para atualizar a chave de recuperacao de senha conforme solicitação
     * do usuário, retorna o número de linhas afetadas, pois um usuário pode estar cadastrado
     * com o mesmo email em mais de um cliente
     * @return Int
     */
    public function setChaveRecuperacaoSenhaEmail(){
        $sql = "UPDATE pessoa SET dc_chave_recuperacao_senha = ? WHERE dc_email = ?;";
        $params = array($this->getDc_chave(),$this->getDc_email());
        $result = $this->query($sql,$params);
        return $result->rowCount() ? true : false;
    }

    /*
     * Seleciona o usuário pela chave de recuperação de senha
     * @return Array
     */
    public function getPessoaChaveRecuperacao(){
        $sql = "SELECT * FROM pessoa WHERE dc_chave_recuperacao_senha = ?";
        $params = array($this->getDc_chave());
        $result = $this->query($sql,$params);
        return $result->fetch();
    }
    
    /*
     * Altera a senha conforme o email informado, e retorna a quantidade
     * de linhas afetadas, informando se o usuário possui mais de um registro
     * de senha, em dois clientes distintos por exemplo
     * @return Integer
     */
    public function setSenhaEmail(){
        $sql = "UPDATE pessoa SET dc_senha = ?,"
             . "qt_tentativa_acesso = 0,dc_chave_recuperacao_senha = NULL, "
             . "id_usuario_bloqueado = FALSE WHERE dc_email = ?;";
        $params = array($this->getDc_senha(),$this->getDc_email());
        $result = $this->query($sql,$params);
        //print_r($result); exit;
        return $result->rowCount() ? true : false;
    }
    
    /*
     * Seleciona no banco de dados todas as permissões
     * que o usuário possui.
     * OBS: Faz o acesso apenas uma vez
     * necessário logout, login do usuário para atualizar.
     */
    public function getPermissoesUsuario() {
        $sql = "SELECT id_entidade,id_permissao FROM permissao_pessoa_tipo WHERE id_pessoa_tipo = ?";
        $params = array($this->getId_pessoa_tipo());
        $result = $this->query($sql, $params);
        $row = $result->fetchAll();
        $row = array_map('array_values', $row);
        return $row;
    }
}