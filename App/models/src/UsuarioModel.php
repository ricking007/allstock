<?php

namespace App\models;

use Framework\core\Model;
use App\libs\Bcrypt;

class UsuarioModel extends Model {

    private $id_pessoa,
            $no_nome_completo,
            $dc_email,
            $id_pessoa_tipo,
            $dc_senha,
            $id_usuario_bloqueado;

    function __construct() {
        parent::__construct();
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function getNo_nome_completo() {
        return $this->no_nome_completo;
    }

    function getDc_email() {
        return $this->dc_email;
    }

    function getId_pessoa_tipo() {
        return $this->id_pessoa_tipo;
    }

    function setNo_nome_completo($no_nome_completo) {
        $this->no_nome_completo = $this->filterVarString($no_nome_completo);
    }

    function setDc_email($dc_email) {
        $this->dc_email = $this->filterVarEmail($dc_email);
    }

    function setId_pessoa_tipo($id_pessoa_tipo) {
        $this->id_pessoa_tipo = $this->filterVarInt($id_pessoa_tipo);
    }

    function getDc_senha() {
        return $this->dc_senha;
    }

    function setDc_senha($dc_senha) {
        $this->dc_senha = Bcrypt::hash($dc_senha);
    }

    function getId_usuario_bloqueado() {
        return $this->id_usuario_bloqueado;
    }

    function setId_usuario_bloqueado($id_usuario_bloqueado) {
        $this->id_usuario_bloqueado = $this->filterVarInt($id_usuario_bloqueado);
    }

    function getUsuarios() {
        $sql = "SELECT p.id_pessoa,p.id_pessoa_tipo,p.no_nome_completo, " .
                "DATE_FORMAT(p.dt_ultimo_acesso,'%d/%m/%Y %H:%i:%s') as dt_ultimo_acesso,"
                . "p.id_usuario_bloqueado,p.qt_tentativa_acesso,pe.dc_img_perfil "
                . "FROM pessoa p LEFT JOIN perfil pe ON p.id_pessoa = pe.id_pessoa "
                . " WHERE p.id_pessoa <> 1;";
        $res = $this->query($sql);
        return $res->fetchAll();
    }

    function getUsuario() {
        $sql = "SELECT id_pessoa,no_nome_completo,dc_email,id_pessoa_tipo,id_usuario_bloqueado FROM pessoa WHERE id_pessoa = ?";
        $params = array($this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }

    function set() {
        if ($this->getId_pessoa()) {
            $sql = "UPDATE pessoa SET no_nome_completo = ?,dc_email = ?,id_pessoa_tipo = ?,dc_senha = ?, id_usuario_bloqueado = ?, qt_tentativa_acesso = 0"
                    . " WHERE id_pessoa = ?;";
            $params = array($this->getNo_nome_completo(), $this->getDc_email(), $this->getId_pessoa_tipo(),
                $this->getDc_senha(), $this->getId_usuario_bloqueado(), $this->getId_pessoa());
            $res = $this->query($sql, $params);
            return $res->rowCount();
        } else {
            $sql = "INSERT INTO pessoa (no_nome_completo,dc_email,id_pessoa_tipo,dc_senha,id_usuario_bloqueado) VALUES (?,?,?,?,?);";
            $params = array($this->getNo_nome_completo(), $this->getDc_email(), $this->getId_pessoa_tipo(), $this->getDc_senha(), $this->getId_usuario_bloqueado());
            $this->query($sql, $params);
            $this->setId_pessoa($this->lastInsertId);
            $this->setPerfil();
            return $this->getId_pessoa();
        }
    }

    function setPerfil() {
        $sql = "INSERT INTO perfil (id_pessoa) VALUES (?);";
        $params = array($this->getId_pessoa());
        $this->query($sql, $params);
    }

    function getUsuarioSearch() {
        $sql = "SELECT no_nome_completo,id_pessoa FROM pessoa WHERE no_nome_completo LIKE ?"
                . " ORDER BY id_pessoa;";
        $params = array("%{$this->getNo_nome_completo()}%");
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }

    function delete() {
        $sql = "DELETE FROM pessoa WHERE id_pessoa = ?";
        $params = array($this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }

}
