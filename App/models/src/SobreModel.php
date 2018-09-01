<?php
namespace App\models;
use Framework\core\Model;
class SobreModel extends Model {
    private $dc_sobre;
    function __construct() {
        parent::__construct();
    }
    function getDc_sobre() {
        return $this->dc_sobre;
    }

    function setDc_sobre($dc_sobre) {
        $this->dc_sobre = $dc_sobre;
    }
    
    function updDcSobre(){
        $sql = "UPDATE sobre SET dc_sobre = ?";
        $params = array($this->getDc_sobre());
        $res = $this->query($sql, $params);
        //var_dump($res);
        return $res->rowCount();
    }
    function get(){
        $sql = "SELECT dc_sobre FROM sobre;";
        $res = $this->query($sql);
        $row = $res->fetch();
        $this->setDc_sobre($row['dc_sobre']);
    }

    

}
