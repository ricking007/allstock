<?php
namespace App\models;
class PessoaFisicaModel extends ClientModel {
    
    private $nm_cpf,
            $nm_rg;
    
    function __construct() {
        parent::__construct();
    }
    function getNm_cpf() {
        return $this->nm_cpf;
    }

    function getNm_rg() {
        return $this->nm_rg;
    }

    function setNm_cpf($nm_cpf) {
        $this->nm_cpf = $this->filterVarString($nm_cpf);
    }

    function setNm_rg($nm_rg) {
        $this->nm_rg = $this->filterVarString($nm_rg);
    }
    function setClient(){
        $id_cliente = $this->set(); //cria o cliente na tabela cliente
        if($this->getId_cliente()){
            $sql = "UPDATE pessoa_fisica SET nm_cpf = ?, nm_rg = ? WHERE id_cliente = ?;";
            $params = array($this->getNm_cpf(),$this->getNm_rg(),$this->getId_cliente());
            $this->query($sql, $params);
        } else {
            $sql = "INSERT INTO pessoa_fisica (id_cliente,nm_cpf,nm_rg) VALUES (?,?,?);";
            $params = array($id_cliente,$this->getNm_cpf(),$this->getNm_rg());
            $this->query($sql, $params);
            $this->setId_cliente($id_cliente);
        }
    }

    
    

}
