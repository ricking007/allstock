<?php

namespace App\models;

use Framework\core\Model;
use DateTime;

class ProdutoModel extends Model {

    private $id_pessoa,
            $id_produto,
            $dc_produto,
            $dc_descricao,
            $id_categoria,
            $nm_valor,
            $cd_barra,
            $nm_estoque,
            $nm_estoque_min,
            $id_marca,
            $nm_porcentagem,
            $id_promocao,
            $dt_exp_promocao,
            $id_embalagem,
            $qt_embalagem,
            $nm_limite,
            $nm_offset,
            $dc_order,
            $cd_produto_cliente;

    function __construct() {
        parent::__construct();
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getId_produto() {
        return $this->id_produto;
    }

    function getDc_produto() {
        return $this->dc_produto;
    }

    function getDc_descricao() {
        return $this->dc_descricao;
    }

    function getId_categoria() {
        return $this->id_categoria;
    }

    function getNm_valor() {
        return $this->nm_valor;
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }

    function setId_produto($id_produto) {
        $this->id_produto = $this->filterVarInt($id_produto);
    }

    function setDc_produto($dc_produto) {
        $this->dc_produto = $this->filterVarString($dc_produto);
    }

    function setDc_descricao($dc_descricao) {
        $this->dc_descricao = $dc_descricao;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $this->filterVarInt($id_categoria);
    }

    function setNm_valor($nm_valor) {
        $this->nm_valor = $this->filterVarFloat($nm_valor);
    }

    function getCd_barra() {
        return $this->cd_barra;
    }

    function setCd_barra($cd_barra) {
        $this->cd_barra = $this->filterVarString($cd_barra);
    }

    function getNm_estoque() {
        return $this->nm_estoque;
    }

    function getNm_estoque_min() {
        return $this->nm_estoque_min;
    }

    function setNm_estoque($nm_estoque) {
        $this->nm_estoque = $this->filterVarInt($nm_estoque);
    }

    function setNm_estoque_min($nm_estoque_min) {
        $this->nm_estoque_min = $this->filterVarInt($nm_estoque_min);
    }

    function getId_marca() {
        return $this->id_marca;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $this->filterVarInt($id_marca);
    }

    function getNm_porcentagem() {
        return $this->nm_porcentagem;
    }

    function setNm_porcentagem($nm_porcentagem) {
        $this->nm_porcentagem = $this->filterVarFloat($nm_porcentagem);
    }

    function getId_promocao() {
        return $this->id_promocao;
    }

    function setId_promocao($id_promocao) {
        $this->id_promocao = $this->filterVarInt($id_promocao);
    }

    function getDt_exp_promocao() {
        return $this->dt_exp_promocao;
    }

    function getId_embalagem() {
        return $this->id_embalagem;
    }

    function getQt_embalagem() {
        return $this->qt_embalagem;
    }

    function setDt_exp_promocao($dt_exp_promocao) {
        if ($dt_exp_promocao) {
            $d = DateTime::createFromFormat('d/m/Y H:i', $dt_exp_promocao);
            $this->dt_exp_promocao = $d->format('Y-m-d H:i:s');
        } else {
            $this->dt_exp_promocao = NULL;
        }
    }

    function setId_embalagem($id_embalagem) {
        $this->id_embalagem = $this->filterVarInt($id_embalagem);
    }

    function setQt_embalagem($qt_embalagem) {
        $this->qt_embalagem = $qt_embalagem;
    }

    function getNm_limite() {
        return $this->nm_limite;
    }

    function getNm_offset() {
        return $this->nm_offset;
    }

    function setNm_limite($nm_limite) {
        $this->nm_limite = $this->filterVarInt($nm_limite);
    }

    function setNm_offset($nm_offset) {
        $this->nm_offset = $this->filterVarInt($nm_offset);
    }

    function getDc_order() {
        return $this->dc_order;
    }

    function setDc_order($dc_order) {
        $this->dc_order = $this->filterVarString($dc_order);
    }

    function getCd_produto_cliente() {
        return $this->cd_produto_cliente;
    }

    function setCd_produto_cliente($cd_produto_cliente) {
        $this->cd_produto_cliente = $this->filterVarInt($cd_produto_cliente);
    }

    function set() {
        if ($this->getId_produto()) {
            $sql = "UPDATE produto SET id_marca = ?,id_categoria = ?, nm_porcentagem = ?, dc_produto = ?, dc_descricao = ?, nm_valor = ?, "
                    . " nm_estoque = ?, nm_estoque_min = ?, id_promocao = ?, dt_exp_promocao = ?, id_embalagem = ?, qt_embalagem = ? "
                    . " WHERE id_produto = ? AND id_pessoa = ?;";
            $params = array($this->getId_marca(), $this->getId_categoria(), $this->getNm_porcentagem(), $this->getDc_produto(),
                $this->getDc_descricao(), $this->getNm_valor(),
                $this->getNm_estoque(), $this->getNm_estoque_min(), $this->getId_promocao(),
                $this->getDt_exp_promocao(), $this->getId_embalagem(), $this->getQt_embalagem(),
                $this->getId_produto(), $this->getId_pessoa());
            //print_r($params);exit;
            $res = $this->query($sql, $params);
            if ($res) {
                return $this->getId_produto();
            } else {
                return false;
            }
        } else {
            $sql = "INSERT INTO produto (id_pessoa,id_marca,id_categoria,nm_porcentagem,"
                    . "dc_produto,dc_descricao,nm_valor,nm_estoque,nm_estoque_min,"
                    . "id_promocao,dt_exp_promocao,id_embalagem,qt_embalagem,cd_produto_cliente) "
                    . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
            $params = array($this->getId_pessoa(),$this->getId_marca(), $this->getId_categoria(),
                $this->getNm_porcentagem(), $this->getDc_produto(),
                $this->getDc_descricao(), $this->getNm_valor(),
                $this->getNm_estoque(), $this->getNm_estoque_min(), $this->getId_promocao(),
                $this->getDt_exp_promocao(), $this->getId_embalagem(), $this->getQt_embalagem(),
                $this->getCd_produto_cliente());
            $this->query($sql, $params);
            return $this->lastInsertId;
        }
    }

    function getTotalProdutos() {
        $sql = "SELECT count(id_produto) as total FROM produto";
        if ($this->getDc_produto()) {
            $sql .= " WHERE dc_produto LIKE ? ";
            $params = array("%{$this->getDc_produto()}%");
        }
        if (empty($params)) {
            $res = $this->query($sql);
        } else {
            $res = $this->query($sql, $params);
        }
        $row = $res->fetch();
        return $row['total'];
    }

    function getProdutos() {
        $sql = "SELECT p.id_produto,p.dc_produto,p.dc_descricao,p.nm_valor,c.no_categoria,m.no_marca,id_promocao,nm_estoque, "
                . "FORMAT(nm_valor - (nm_valor * nm_porcentagem / 100),2) as nm_valor_venda,"
                . "DATE_FORMAT(dt_exp_promocao,'%d/%m/%Y %H:%i') as dt_exp_promocao,"
                . " (SELECT count(*) FROM produto_foto pf WHERE pf.id_produto = p.id_produto ) as qtd_fotos,cd_produto_cliente "
                . " FROM produto p LEFT JOIN categoria c ON p.id_categoria = c.id_categoria"
                . " LEFT JOIN marca m ON p.id_marca = m.id_marca WHERE p.id_status = 1 AND p.id_pessoa = ?";
         $params = array($this->getId_pessoa());
        if ($this->getDc_produto()) {
            $sql .= " AND (dc_produto LIKE ? OR cd_produto_cliente LIKE ?) ";
            $params .= array("%{$this->getDc_produto()}%", "%{$this->getDc_produto()}%");
        }
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }

    function getProdutosSearch() {
        $sql = "SELECT p.id_produto,p.dc_produto,p.dc_descricao,p.nm_valor,c.no_categoria,m.no_marca,id_promocao,nm_estoque, "
                . "FORMAT(nm_valor - (nm_valor * nm_porcentagem / 100),2) as nm_valor_venda,"
                . "DATE_FORMAT(dt_exp_promocao,'%d/%m/%Y %H:%i') as dt_exp_promocao"
                . " FROM produto p LEFT JOIN categoria c ON p.id_categoria = c.id_categoria"
                . " LEFT JOIN marca m ON p.id_marca = m.id_marca"
                . " WHERE id_status = 1 AND dc_produto LIKE ?"
                . " ORDER BY id_produto;";
        $params = array("%{$this->getDc_produto()}%");
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }

    function getProduto() {
        $sql = "SELECT id_produto,id_categoria,dc_produto,dc_descricao,nm_valor,id_promocao,nm_estoque, "
                . "id_status,cd_barra,nm_estoque,nm_estoque_min,id_marca,nm_porcentagem,id_embalagem,qt_embalagem,"
                . "FORMAT(nm_valor - (nm_valor * nm_porcentagem / 100),2) as nm_valor_venda,"
                . "DATE_FORMAT(dt_exp_promocao,'%d/%m/%Y %H:%i') as dt_exp_promocao"
                . " FROM produto WHERE id_status = 1 AND id_produto = ? AND id_pessoa = ?;";
        $params = array($this->getId_produto(), $this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }

    function getProdutoSite() {
        $sql = "SELECT * FROM site_produto WHERE id_produto = ? AND id_status = 1 AND id_pessoa = ?;";
        $params = array($this->getId_produto(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }

    function delete() {
        $sql = "DELETE FROM produto WHERE id_produto = ? AND id_pessoa = ?;";
        $params = array($this->getId_produto(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }

    function getProdutoCodBarra() {
        $sql = "SELECT * FROM produto WHERE cd_barra = ? AND id_pessoa = ?;";
        $params = array($this->getCd_barra(),$this->getId_pessoa());
        $res = $this->query($sql, $params);
        return $res->fetch();
    }

    function import($query) {
        $sql = "INSERT INTO produto (dc_produto,nm_valor,nm_estoque,qt_embalagem,nm_porcentagem,id_status) VALUES $query";
        //exit($sql);
        $this->query($sql);
    }

    function getProdutoByCod() {
        $sql = "SELECT id_produto,id_categoria FROM produto WHERE cd_produto_cliente = ? AND id_status = 1 AND id_pessoa = ?";
        $params = array($this->getCd_produto_cliente(), $this->getId_pessoa());
        $res = $this->query($sql, $params);
        $row = $res->fetch();
        if (!empty($row)) {
            $this->setId_produto($row['id_produto']);
            if (!empty($row['id_categoria'])) {
                $this->setId_categoria($row['id_categoria']);
            }
        }
    }

    function setIdCategoriaProduto() {
        $sql = "UPDATE produto SET id_categoria = ? WHERE id_produto = ?;";
        $params = array($this->getId_categoria(), $this->getId_produto());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }

}
