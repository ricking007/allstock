<?php
namespace App\models;
class PessoaJuridicaModel extends ClientModel {
    private $dc_razao_social,
            $nm_cnpj,
            $nm_ie,
            $nm_im;
    function __construct() {
        parent::__construct();
    }
    function getDc_razao_social() {
        return $this->dc_razao_social;
    }

    function getNm_cnpj() {
        return $this->nm_cnpj;
    }

    function getNm_ie() {
        return $this->nm_ie;
    }

    function getNm_im() {
        return $this->nm_im;
    }

    function setDc_razao_social($dc_razao_social) {
        $this->dc_razao_social = $this->filterVarString($dc_razao_social);
    }

    function setNm_cnpj($nm_cnpj) {
        $this->nm_cnpj = $this->filterVarString($nm_cnpj);
    }

    function setNm_ie($nm_ie) {
        $this->nm_ie = $this->filterVarString($nm_ie);
    }

    function setNm_im($nm_im) {
        $this->nm_im = $this->filterVarString($nm_im);
    }
    
    function setClient(){
        $id_cliente = $this->set(); //cria o cliente na tabela cliente
        if($this->getId_cliente()){
            $sql = "UPDATE pessoa_juridica SET dc_razao_social = ?, nm_cnpj = ?,"
                    . "nm_ie = ?, nm_im = ? WHERE id_cliente = ?;";
            $params = array($this->getDc_razao_social(),$this->getNm_cnpj(),
                            $this->getNm_ie(),$this->getNm_im(),$this->getId_cliente());
            $this->query($sql, $params);
        } else {
            $sql = "INSERT INTO pessoa_juridica (id_cliente,dc_razao_social,nm_cnpj,"
                    . "nm_ie,nm_im) VALUES (?,?,?,?,?);";
            $params = array($id_cliente,$this->getDc_razao_social(),
                            $this->getNm_cnpj(),$this->getNm_ie(),$this->getNm_im());
            $this->query($sql, $params);
            $this->setId_cliente($id_cliente);
        }
    }



}

