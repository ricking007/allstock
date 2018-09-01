<?php
namespace App\models;
use Framework\core\Model;

class ClientModel extends Model
{
    private $id_cliente,
            $id_criado_por,
            $id_endereco,
            $id_status,
            $dt_cadastro,
            $id_cliente_tipo,
            $no_cliente,
            $dc_email;
    public function __construct() {
        parent::__construct();
    }
    function getId_cliente() {
        return $this->id_cliente;
    }

    function getId_criado_por() {
        return $this->id_criado_por;
    }

    function getId_endereco() {
        return $this->id_endereco;
    }

    function getId_status() {
        return $this->id_status;
    }

    function getDt_cadastro() {
        return $this->dt_cadastro;
    }

    function getId_cliente_tipo() {
        return $this->id_cliente_tipo;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $this->filterVarInt($id_cliente);
    }

    function setId_criado_por($id_criado_por) {
        $this->id_criado_por = $this->filterVarInt($id_criado_por);
    }

    function setId_endereco($id_endereco) {
        $this->id_endereco = $this->filterVarInt($id_endereco);
    }

    function setId_status($id_status) {
        $this->id_status = $this->filterVarInt($id_status);
    }

    function setDt_cadastro($dt_cadastro) {
        $this->dt_cadastro = $this->filterVarDate($dt_cadastro);
    }

    function setId_cliente_tipo($id_cliente_tipo) {
        $this->id_cliente_tipo = $this->filterVarInt($id_cliente_tipo);
    }
    function getNo_cliente() {
        return $this->no_cliente;
    }

    function setNo_cliente($no_cliente) {
        $this->no_cliente = $this->filterVarString($no_cliente);
    }
    function getDc_email() {
        return $this->dc_email;
    }

    function setDc_email($dc_email) {
        $this->dc_email = $this->filterVarEmail($dc_email);
    }

    function set(){
        if($this->getId_cliente()){
            $sql = "UPDATE cliente SET no_cliente = ?, id_criado_por = ?, id_endereco = ?, "
                    . " id_status = ?, dc_email = ? WHERE id_cliente = ?;";
            $params = array($this->getNo_cliente(),$this->getId_criado_por(),$this->getId_endereco(),
                        $this->getId_status(),$this->getDc_email(),$this->getId_cliente());
            $res = $this->query($sql, $params);
            return $res->rowCount();
        } else {
            $sql = "INSERT INTO cliente (no_cliente,id_criado_por,id_endereco,id_status,id_cliente_tipo,dc_email)"
                   . " VALUES (?,?,?,?,?,?);";
            $params = array($this->getNo_cliente(),$this->getId_criado_por(),$this->getId_endereco(),
                        $this->getId_status(),$this->getId_cliente_tipo(),$this->getDc_email());
            $this->query($sql, $params);
            return $this->lastInsertId;
        }
        
    }
    function getClients(){
        $sql = "SELECT c.id_cliente,c.no_cliente,DATE_FORMAT(c.dt_cadastro,'%d/%m/%Y') as dt_cadastro,".
                " c.id_cliente_tipo,c.id_status,p.no_nome_completo as no_cadastrado_por".
                " FROM cliente c".
                " LEFT JOIN pessoa_fisica pf ON c.id_cliente = pf.id_cliente".
                " LEFT JOIN pessoa_juridica pj ON c.id_cliente = pj.id_cliente".
                " LEFT JOIN pessoa p ON c.id_criado_por = p.id_pessoa ORDER BY id_cliente DESC;";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
    function getClient(){
        $sql = "SELECT c.id_cliente,c.no_cliente,c.id_endereco,c.dc_email,pj.dc_razao_social,pj.nm_cnpj,".
                " pj.nm_ie,pf.nm_cpf,pf.nm_rg,c.id_cliente_tipo,c.id_status".
                " FROM cliente c".
                " LEFT JOIN pessoa_fisica pf ON c.id_cliente = pf.id_cliente".
                " LEFT JOIN pessoa_juridica pj ON c.id_cliente = pj.id_cliente".
                " WHERE c.id_cliente = ?;";
        $params = array($this->getId_cliente());
        $res = $this->query($sql,$params);
        return $res->fetch();
    }
    function delete(){
        $sql = "DELETE FROM cliente WHERE id_cliente = ?";
        $params = array($this->getId_cliente());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }


}

