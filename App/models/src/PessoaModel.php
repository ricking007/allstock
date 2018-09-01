<?php
namespace App\models;
use Framework\core\Model;
class PessoaModel  extends Model {
    
    private $id_pessoa,
            $id_pessoa_tipo,
            $id_cliente,
            $id_endereco,
            $no_nome_completo,
            $dc_email,
            $dc_senha,
            $dc_sexo;
    
    function __construct() {
        parent::__construct();
    }
    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getId_pessoa_tipo() {
        return $this->id_pessoa_tipo;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function getId_endereco() {
        return $this->id_endereco;
    }

    function getNo_nome_completo() {
        return $this->no_nome_completo;
    }

    function getDc_email() {
        return $this->dc_email;
    }

    function getDc_senha() {
        return $this->dc_senha;
    }

    function getDc_sexo() {
        return $this->dc_sexo;
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setId_pessoa_tipo($id_pessoa_tipo) {
        $this->id_pessoa_tipo = $this->filterVarInt($id_pessoa_tipo);
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $this->filterVarInt($id_cliente);
    }

    function setId_endereco($id_endereco) {
        $this->id_endereco = $this->filterVarInt($id_endereco);
    }

    function setNo_nome_completo($no_nome_completo) {
        $this->no_nome_completo = $this->filterVarString($no_nome_completo);
    }

    function setDc_email($dc_email) {
        $this->dc_email = $this->filterVarEmail($dc_email);
    }

    function setDc_senha($dc_senha) {
        $this->dc_senha = \App\libs\Bcrypt::hash($dc_senha);
    }

    function setDc_sexo($dc_sexo) {
        $this->dc_sexo = $this->filterVarString($dc_sexo);
    }
    function setPessoa(){
        $sql = "INSERT INTO pessoa (id_pessoa_tipo,id_cliente,id_endereco,no_nome_completo,dc_email,dc_senha,dc_sexo)".
                " VALUES (?,?,?,?,?,?,?);";
        $params = array($this->getId_pessoa_tipo(),$this->getId_cliente(),$this->getId_endereco(),
                        $this->getNo_nome_completo(),$this->getDc_email(),$this->getDc_senha(),
                        $this->getDc_sexo());
        $this->query($sql, $params);
        $this->setId_pessoa($this->lastInsertId);
        return $this->lastInsertId;
    }



}

