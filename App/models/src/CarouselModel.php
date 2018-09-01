<?php
namespace App\models;
use Framework\core\Model;
class CarouselModel extends Model {
    private $id_carousel,
            $dc_capiton,
            $dc_link,
            $dc_imagem,
            $dt_carousel,
            $id_cadastrado_por;
    function __construct() {
        parent::__construct();
    }
    function getId_carousel() {
        return $this->id_carousel;
    }

    function getDc_capiton() {
        return $this->dc_capiton;
    }

    function getDc_link() {
        return $this->dc_link;
    }

    function getDc_imagem() {
        return $this->dc_imagem;
    }

    function getDt_carousel() {
        return $this->dt_carousel;
    }

    function getId_cadastrado_por() {
        return $this->id_cadastrado_por;
    }

    function setId_carousel($id_carousel) {
        $this->id_carousel = $this->filterVarInt($id_carousel);
    }

    function setDc_capiton($dc_capiton) {
        $this->dc_capiton = $dc_capiton;
    }

    function setDc_link($dc_link) {
        if (!filter_var($dc_link, FILTER_VALIDATE_URL) === false) {
            $this->dc_link = $dc_link;
        } else {
            $this->dc_link = NULL;
        }
    }

    function setDc_imagem($dc_imagem) {
        $this->dc_imagem = $this->filterVarString($dc_imagem);
    }

    function setDt_carousel($dt_carousel) {
        $this->dt_carousel = $dt_carousel;
    }

    function setId_cadastrado_por($id_cadastrado_por) {
        $this->id_cadastrado_por = $this->filterVarInt($id_cadastrado_por);
    }
    function setCarousel(){
        $sql = "INSERT INTO carousel (dc_caption,dc_link,dc_imagem,id_cadastrado_por) VALUES (?,?,?,?);";
        $params = array($this->getDc_capiton(),$this->getDc_link(),$this->getDc_imagem(),$this->getId_cadastrado_por());
        $this->query($sql, $params);
        $this->setId_carousel($this->lastInsertId);
        return $this->lastInsertId;
    }
    function getCarousel(){
        $sql = "SELECT * FROM carousel ORDER BY id_carousel;";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
    function delete(){
        $sql = "DELETE FROM carousel WHERE id_carousel = ?";
        $params = array($this->getId_carousel());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    function getConfig(){
        $sql = "SELECT id_carousel,dc_caption,dc_link FROM carousel WHERE id_carousel = ?;";
        $res = $this->query($sql,array($this->getId_carousel()));
        return $res->fetch();
    }
    function updCarousel(){
        $sql = "UPDATE carousel SET dc_caption = ?, dc_link = ? WHERE id_carousel = ?";
        $params = array($this->getDc_capiton(),$this->getDc_link(),$this->getId_carousel());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }


}

