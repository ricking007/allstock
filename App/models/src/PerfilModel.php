<?php
namespace App\models;
use Framework\core\Model;
use App\libs\Bcrypt;
class PerfilModel extends Model {
    private $id_pessoa,
            $dc_tema,
            $dc_img_perfil,
            $dc_senha;
    function __construct() {
        parent::__construct();
    }
    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getDc_tema() {
        return $this->dc_tema;
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setDc_tema($dc_tema) {
        $this->dc_tema = $this->filterVarString($dc_tema);
    }
    
    function getDc_img_perfil() {
        return $this->dc_img_perfil;
    }

    function setDc_img_perfil($dc_img_perfil) {
        $this->dc_img_perfil = $this->filterVarString($dc_img_perfil);
    }
    
    function getDc_senha() {
        return $this->dc_senha;
    }

    function setDc_senha($dc_senha) {
        $this->dc_senha = Bcrypt::hash($dc_senha);
    }

    function setTema(){
        $sql = "UPDATE perfil SET dc_tema = ? WHERE id_pessoa = ?";
        $params = array($this->getDc_tema(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    
    function setImg(){
        $sql = "UPDATE perfil SET dc_img_perfil = ? WHERE id_pessoa = ?";
        $params = array($this->getDc_img_perfil(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    function getPass(){
        $sql = "SELECT dc_senha FROM pessoa WHERE id_pessoa = ?;";
        $params = array($this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }
    function updSenha(){
        $sql = "UPDATE pessoa SET dc_senha = ? WHERE id_pessoa = ?;";
        $params = array($this->getDc_senha(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }


}
