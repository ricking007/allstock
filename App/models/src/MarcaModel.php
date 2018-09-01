<?php

namespace App\models;

use Framework\core\Model;

class MarcaModel extends Model {

    private $id_marca,
            $id_pessoa,
            $no_marca;

    function __construct() {
        parent::__construct();
    }

    function getId_marca() {
        return $this->id_marca;
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getNo_marca() {
        return $this->no_marca;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $this->filterVarInt($id_marca);
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setNo_marca($no_marca) {
        $this->no_marca = $this->filterVarString($no_marca);
    }

    function getMarcas() {
        $sql = "SELECT * FROM marca WHERE id_pessoa = ? ORDER BY no_marca;";
        $params = array($this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }

    function getMarca() {
        $sql = "SELECT * FROM marca WHERE id_marca = ? AND id_pessoa = ?";
        $params = array($this->getId_marca(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }

    function set() {
        if ($this->getId_marca()) {
            $sql = "UPDATE marca SET no_marca = ?"
                    . " WHERE id_marca = ? AND id_pessoa = ?;";
            $params = array($this->getNo_marca(), $this->getId_marca(), $this->getId_pessoa());
            $res = $this->query($sql, $params);
            return $res->rowCount();
        } else {
            $sql = "INSERT INTO marca (id_pessoa,no_marca) VALUES (?,?);";
            $params = array($this->getId_pessoa(),$this->getNo_marca());
            $this->query($sql, $params);
            return $this->lastInsertId;
        }
    }

    function delete() {
        $sql = "DELETE FROM marca WHERE id_marca = ? AND id_pessoa = ?;";
        $params = array($this->getId_marca(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }

    function getIdMarcaByNome() {
        $sql = "SELECT id_marca FROM marca WHERE no_marca = ? AND id_pessoa = ?";
        $params = array($this->getNo_marca(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        $row = $res->fetch();
        if (!empty($row)) {
            return $row['id_marca'];
        } else {
            return $this->set();
        }
    }

}
