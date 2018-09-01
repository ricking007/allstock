<?php

namespace App\models;

use Framework\core\Model;

class CategoriaModel extends Model {

    private $id_categoria,
            $id_pessoa,
            $no_categoria;

    function __construct() {
        parent::__construct();
    }

    function getId_categoria() {
        return $this->id_categoria;
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getNo_categoria() {
        return $this->no_categoria;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $this->filterVarInt($id_categoria);
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setNo_categoria($no_categoria) {
        $this->no_categoria = $this->filterVarString($no_categoria);
    }

    function getCategorias() {
        $sql = "SELECT * FROM categoria WHERE id_pessoa = ? ORDER BY no_categoria;";
        $params = array($this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }

    function getCategoria() {
        $sql = "SELECT * FROM categoria WHERE id_categoria = ? AND id_pessoa = ?";
        $params = array($this->getId_categoria(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }

    function set() {
        if ($this->getId_categoria()) {
            $sql = "UPDATE categoria SET no_categoria = ?"
                    . " WHERE id_categoria = ? AND id_pessoa = ?;";
            $params = array($this->getNo_categoria(), $this->getId_categoria(),$this->getId_pessoa());
            $res = $this->query($sql, $params);
            return $res->rowCount();
        } else {
            $sql = "INSERT INTO categoria (id_pessoa,no_categoria) VALUES (?,?);";
            $params = array($this->getId_pessoa(),$this->getNo_categoria());
            $this->query($sql, $params);
            return $this->lastInsertId;
        }
    }

    function delete() {
        $sql = "DELETE FROM categoria WHERE id_categoria = ? AND id_pessoa = ?;";
        $params = array($this->getId_categoria(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }

}