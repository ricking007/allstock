<?php
namespace App\models;
use Framework\core\Model;
class EnderecoModel extends Model {
    private $id_endereco,
            $dc_logradouro,
            $nm_numero,
            $dc_complemento,
            $dc_bairro,
            $dc_municipio,
            $nm_cep,
            $dc_uf,
            $nm_telefone,
            $nm_celular;
    function __construct() {
        parent::__construct();
    }
    function getId_endereco() {
        return $this->id_endereco;
    }

    function getDc_logradouro() {
        return $this->dc_logradouro;
    }

    function getNm_numero() {
        return $this->nm_numero;
    }

    function getDc_complemento() {
        return $this->dc_complemento;
    }

    function getDc_bairro() {
        return $this->dc_bairro;
    }

    function getDc_municipio() {
        return $this->dc_municipio;
    }

    function getNm_cep() {
        return $this->nm_cep;
    }

    function getDc_uf() {
        return $this->dc_uf;
    }

    function setId_endereco($id_endereco) {
        $this->id_endereco = $this->filterVarInt($id_endereco);
    }

    function setDc_logradouro($dc_logradouro) {
        $this->dc_logradouro = $this->filterVarString($dc_logradouro);
    }

    function setNm_numero($nm_numero) {
        $this->nm_numero = $this->filterVarInt($nm_numero);
    }

    function setDc_complemento($dc_complemento) {
        $this->dc_complemento = $this->filterVarString($dc_complemento);
    }

    function setDc_bairro($dc_bairro) {
        $this->dc_bairro = $this->filterVarString($dc_bairro);
    }

    function setDc_municipio($dc_municipio) {
        $this->dc_municipio = $this->filterVarString($dc_municipio);
    }

    function setNm_cep($nm_cep) {
        $this->nm_cep = $this->filterVarNumber($nm_cep);
    }

    function setDc_uf($dc_uf) {
        $this->dc_uf = $this->filterVarString($dc_uf);
    }
    function getNm_telefone() {
        return $this->nm_telefone;
    }

    function getNm_celular() {
        return $this->nm_celular;
    }

    function setNm_telefone($nm_telefone) {
        $this->nm_telefone = $this->filterVarString($nm_telefone);
    }

    function setNm_celular($nm_celular) {
        $this->nm_celular = $this->filterVarString($nm_celular);
    }
          
    public function setEndereco(){
        if($this->getId_endereco()){
            $sql = "UPDATE endereco SET dc_logradouro = ?, nm_numero = ?, dc_complemento = ?, dc_bairro = ?,"
                    . " dc_municipio = ?, nm_cep = ?, dc_uf = ?, nm_telefone = ?, nm_celular = ?;"
                    . " WHERE id_endereco = ?";
            $params = array($this->getDc_logradouro(),$this->getNm_numero(),$this->getDc_complemento(),
                            $this->getDc_bairro(),$this->getDc_municipio(),$this->getNm_cep(),$this->getDc_uf(),
                            $this->getNm_telefone(),$this->getNm_celular(),$this->getId_endereco());
            $res = $this->query($sql, $params);
            return $res->rowCount();
        } else {
            $sql = "INSERT INTO endereco (dc_logradouro,nm_numero,dc_complemento,dc_bairro,"
                    . "dc_municipio,nm_cep,dc_uf,nm_telefone,nm_celular) VALUES (?,?,?,?,?,?,?,?,?);";
            $params = array($this->getDc_logradouro(),$this->getNm_numero(),$this->getDc_complemento(),
                            $this->getDc_bairro(),$this->getDc_municipio(),$this->getNm_cep(),$this->getDc_uf(),
                            $this->getNm_telefone(),$this->getNm_celular());
            $this->query($sql, $params);
            $this->setId_endereco($this->lastInsertId);
            return $this->lastInsertId;
        }
    }
    public function getEndereco(){
        $sql = "SELECT * FROM endereco WHERE id_endereco = ?;";
        $params = array($this->getId_endereco());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }


    

}