<?php
namespace App\models;
use Framework\core\Model;
class FotoModel extends Model {
    private $id_foto,
            $dc_extensao,
            $id_capa,
            $id_produto,
            $id_pessoa,
            $id_album;
    function __construct() {
        parent::__construct();
    }
    function getId_foto() {
        return $this->id_foto;
    }

    function getDc_extensao() {
        return $this->dc_extensao;
    }

    function getId_capa() {
        return $this->id_capa;
    }

    function getId_produto() {
        return $this->id_produto;
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }
    function getId_album() {
        return $this->id_album;
    }

    function setId_album($id_album) {
        $this->id_album = $this->filterVarInt($id_album);
    }

    function setId_foto($id_foto) {
        $this->id_foto = $this->filterVarInt($id_foto);
    }

    function setDc_extensao($dc_extensao) {
        $this->dc_extensao = $this->filterVarString($dc_extensao);
    }

    function setId_capa($id_capa) {
        $this->id_capa = $this->filterVarInt($id_capa);
    }

    function setId_produto($id_produto) {
        $this->id_produto = $this->filterVarInt($id_produto);
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }
    
    function setFoto(){
        $sql = "INSERT INTO foto (dc_extensao,id_capa) VALUES (?,?);";
        $params = array($this->getDc_extensao(),$this->getId_capa());
        $this->query($sql, $params);
        $this->setId_foto($this->lastInsertId);
        return $this->lastInsertId;
    }
    function setFotoProduto(){
        if($this->setFoto()){
            $sql = "INSERT INTO produto_foto (id_produto,id_foto,id_pessoa) VALUES (?,?,?);";
            $params = array($this->getId_produto(),$this->getId_foto(),$this->getId_pessoa());
            $res = $this->query($sql, $params);
            return $res;
        }
    }
    function getFotosProduto(){
        $sql = "SELECT f.id_foto,f.dc_extensao FROM produto_foto pf "
                . "INNER JOIN foto f ON pf.id_foto = f.id_foto"
                . " WHERE id_produto = ?;";
        $params = array($this->getId_produto());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }
    function delFoto(){
        $sql = "DELETE FROM foto WHERE id_foto = ?;";
        $params = array($this->getId_foto());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    function setCapa(){
        $this->resetCapaProduto();
        $sql = "UPDATE foto SET id_capa = 1 WHERE id_foto = ?";
        $params = array($this->getId_foto());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    private function resetCapaProduto(){
        $sql = "UPDATE foto f INNER JOIN produto_foto pf ON f.id_foto = pf.id_foto".
               " SET f.id_capa = NULL".
               " WHERE pf.id_produto = (SELECT pf2.id_produto FROM produto_foto pf2 WHERE pf2.id_foto = ?);";
        $params = array($this->getId_foto());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    function setCapaGaleria(){
        $this->resetCapaGaleria();
        $sql = "UPDATE foto SET id_capa = 1 WHERE id_foto = ?";
        $params = array($this->getId_foto());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    private function resetCapaGaleria(){
        $sql = "UPDATE foto f INNER JOIN foto_album fa ON f.id_foto = fa.id_foto".
               " SET f.id_capa = NULL".
               " WHERE fa.id_album = (SELECT fa2.id_album FROM foto_album fa2 WHERE fa2.id_foto = ?);";
        $params = array($this->getId_foto());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    function setFotoAlbum(){
        if($this->setFoto()){
            $sql = "INSERT INTO foto_album (id_album,id_foto) VALUES (?,?);";
            $params = array($this->getId_album(),$this->getId_foto());
            $res = $this->query($sql, $params);
            return $res;
        }
    }
    

}

