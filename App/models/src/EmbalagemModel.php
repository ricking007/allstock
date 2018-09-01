<?php

namespace App\models;

use Framework\core\Model;

class EmbalagemModel extends Model {

    private $id_embalagem,
            $id_pessoa,
            $no_embalagem;

    function __construct() {
        parent::__construct();
    }

    function getId_embalagem() {
        return $this->id_embalagem;
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getNo_embalagem() {
        return $this->no_embalagem;
    }

    function setId_embalagem($id_embalagem) {
        $this->id_embalagem = $this->filterVarInt($id_embalagem);
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setNo_embalagem($no_embalagem) {
        $this->no_embalagem = $this->filterVarString($no_embalagem);
    }

    function getEmbalagens() {
        $sql = "SELECT * FROM embalagem WHERE id_pessoa = ? ORDER BY no_embalagem;";
        $params = array($this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }

    function getEmbalagem() {
        $sql = "SELECT * FROM embalagem WHERE id_embalagem = ? AND id_pessoa = ?";
        $params = array($this->getId_embalagem(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }

    function set() {
        if ($this->getId_embalagem()) {
            $sql = "UPDATE embalagem SET no_embalagem = ?"
                    . " WHERE id_embalagem = ? AND id_pessoa = ?;";
            $params = array($this->getNo_embalagem(), $this->getId_embalagem(), $this->getId_pessoa());
            $res = $this->query($sql, $params);
            return $res->rowCount();
        } else {
            $sql = "INSERT INTO embalagem (no_embalagem,id_pessoa) VALUES (?,?);";
            $params = array($this->getNo_embalagem(),$this->getId_pessoa());
            $this->query($sql, $params);
            return $this->lastInsertId;
        }
    }

    function delete() {
        $sql = "DELETE FROM embalagem WHERE id_embalagem = ? AND id_pessoa = ?;";
        $params = array($this->getId_embalagem(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }

    function getIdEmbalagemByNome() {
        $sql = "SELECT id_embalagem FROM embalagem WHERE no_embalagem = ? AND id_pessoa = ?";
        $params = array($this->getNo_embalagem(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        $row = $res->fetch();
        if (!empty($row)) {
            return $row['id_embalagem'];
        } else {
            return $this->set();
        }
    }

}