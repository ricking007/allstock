<?php
namespace App\models;
use Framework\core\Model;
class GaleriaModel extends Model {
    private $id_album,
            $no_album,
            $id_pessoa,
            $id_status,
            $dt_criacao,
            $nm_limite;
    function __construct() {
        parent::__construct();
    }
    function getId_album() {
        return $this->id_album;
    }

    function getNo_album() {
        return $this->no_album;
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getId_status() {
        return $this->id_status;
    }

    function getDt_criacao() {
        return $this->dt_criacao;
    }

    function setId_album($id_album) {
        $this->id_album = $this->filterVarInt($id_album);
    }

    function setNo_album($no_album) {
        $this->no_album = $this->filterVarString($no_album);
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setId_status($id_status) {
        $this->id_status = $this->filterVarInt($id_status);
    }

    function setDt_criacao($dt_criacao) {
        $this->dt_criacao = $dt_criacao;
    }
    function getNm_limite() {
        return $this->nm_limite;
    }

    function setNm_limite($nm_limite) {
        $this->nm_limite = $this->filterVarInt($nm_limite);
    }

    function setAlbum(){
        $sql = "INSERT INTO album (no_album,id_pessoa) VALUES (?,?)";
        $params = array($this->getNo_album(),$this->getId_pessoa());
        $this->query($sql, $params);
        $this->setId_album($this->lastInsertId);
        return $this->lastInsertId;
    }
    
    function getAlbum(){
        $sql = "SELECT * FROM album WHERE id_album = ?;";
        $params = array($this->getId_album());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }
    
    function getAlbuns(){
        $sql = "SELECT a.*,(SELECT count(*) FROM foto_album fa WHERE fa.id_album = a.id_album ) as qtd_fotos"
                . " FROM album a ORDER BY id_album";
        $params = array($this->getId_album());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }
    
    function getFotosAlbum(){
        $sql = "SELECT fa.id_album,f.id_foto,f.dc_extensao,f.id_capa FROM foto_album fa "
                . " INNER JOIN foto f ON fa.id_foto = f.id_foto WHERE fa.id_album = ?";
        $params = array($this->getId_album());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }
    function updTitulo(){
        $sql = "UPDATE album SET no_album = ? WHERE id_album = ?;";
        $params = array($this->getNo_album(),$this->getId_album());
        $res = $this->query($sql, $params);
        return $res->rowCount();
        
    }
    function del(){
        $sql = "DELETE FROM album WHERE id_album = ?";
        $params = array($this->getId_album());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    function getGalerias(){
        $sql = "SELECT a.id_album,a.no_album,".
                " (SELECT CONCAT(f.id_foto,'.',f.dc_extensao) FROM foto_album fa".
                " INNER JOIN foto f ON fa.id_foto = f.id_foto ".
                " WHERE fa.id_album = a.id_album ORDER BY id_capa DESC LIMIT 1) as foto ".
                " FROM album a ORDER BY a.id_album DESC";
        if($this->getNm_limite()){
            $sql .= " LIMIT {$this->getNm_limite()}";
        }
        $sql .= ";";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
    function getFotosGaleria(){
        $sql = "SELECT a.id_album,a.no_album,f.id_foto,f.dc_extensao,f.id_capa ".
               " FROM foto_album fa INNER JOIN album a ON fa.id_album = a.id_album ".
               " INNER JOIN foto f ON fa.id_foto = f.id_foto".
               " WHERE fa.id_album = ?;";
        $params = array($this->getId_album());
        $res = $this->query($sql,$params);
        return $res->fetchAll();
    }
    

}

