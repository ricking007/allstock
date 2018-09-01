<?php

namespace App\models;

use Framework\core\Model;

class ContagemModel extends Model {

    private $id_contagem,
            $id_pessoa,
            $dt_data,
            $id_status,
            $no_status,
            $id_contagem_produto,
            $id_produto,
            $nm_quantidade;

    function __construct() {
        parent::__construct();
    }

    function getId_contagem() {
        return $this->id_contagem;
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getDt_data() {
        return $this->dt_data;
    }

    function getId_status() {
        return $this->id_status;
    }

    function getId_contagem_produto() {
        return $this->id_contagem_produto;
    }

    function getId_produto() {
        return $this->id_produto;
    }

    function getNm_quantidade() {
        return $this->nm_quantidade;
    }

    function setId_contagem($id_contagem) {
        $this->id_contagem = $this->filterVarInt($id_contagem);
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setDt_data($dt_data) {
        $this->dt_data = $dt_data;
    }

    function setId_status($id_status) {
        $this->id_status = $this->filterVarInt($id_status);
    }

    function setId_contagem_produto($id_contagem_produto) {
        $this->id_contagem_produto = $this->filterVarInt($id_contagem_produto);
    }

    function setId_produto($id_produto) {
        $this->id_produto = $this->filterVarInt($id_produto);
    }

    function setNm_quantidade($nm_quantidade) {
        $this->nm_quantidade = $nm_quantidade;
    }

    function setNo_status($no_status) {
        $this->no_status = $this->filterVarString($no_status);
    }

    function getContagens() {
        $sql = "SELECT c.*,s.no_status FROM contagem c LEFT JOIN contagem_status s ON s.id_status = c.id_status "
                . "WHERE c.id_pessoa = ? ORDER BY c.dt_data;";
        $params = array($this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }
    
    function getContagem() {
        $sql = "SELECT c.*,s.no_status, COUNT(cp.id_contagem_produto) as qtd_contagem, (SELECT count(*) "
                . "FROM produto pf WHERE pf.id_pessoa = c.id_pessoa ) as qtd_produtos  FROM contagem_produtos cp "
                . "LEFT JOIN contagem c ON c.id_contagem = cp.id_contagem "
                . "LEFT JOIN contagem_status s ON s.id_status = c.id_status "
                . "WHERE c.id_contagem = ? AND c.id_pessoa = ?;";
        $params = array($this->getId_contagem(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }
    
    function getProduto() {
        $sql = "SELECT cp.nm_quantidade,p.dc_produto,p.nm_estoque FROM contagem_produtos cp "
                . "LEFT JOIN produto p ON p.id_produto = cp.id_produto "
                . "WHERE cp.id_contagem_produto = ?;";
        $params = array($this->getId_contagem_produto());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }
    
    function getContagemProduto() {
        $sql = "SELECT p.dc_produto,p.nm_estoque,cp.nm_quantidade "
                . "FROM contagem_produtos cp LEFT JOIN contagem c ON c.id_contagem = cp.id_contagem "
                . "LEFT JOIN produto p ON p.id_produto = cp.id_produto "
                . "WHERE c.id_contagem = ? AND cp.nm_quantidade != p.nm_estoque LIMIT 5;";
        $params = array($this->getId_contagem());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }
    
    function getContagemProdutos() {
        $sql = "SELECT p.dc_produto,p.nm_estoque,cp.id_contagem_produto,cp.nm_quantidade "
                . "FROM contagem_produtos cp LEFT JOIN contagem c ON c.id_contagem = cp.id_contagem "
                . "LEFT JOIN produto p ON p.id_produto = cp.id_produto "
                . "WHERE c.id_contagem = ?;";
        $params = array($this->getId_contagem());
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }

}
