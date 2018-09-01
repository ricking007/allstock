<?php
namespace App\models;
use Framework\core\Model;
class ProdutosModel extends Model{
    private $id_categoria,
            $dc_produto,
            $id_produto,
            $nm_limite,
            $nm_offset,
            $cd_produto_cliente;
    
    function __construct() {
        parent::__construct();
    }
    
    function getId_categoria() {
        return $this->id_categoria;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $this->filterVarInt($id_categoria);
    }
    
    function getDc_produto() {
        return $this->dc_produto;
    }

    function setDc_produto($dc_produto) {
        $this->dc_produto = $this->filterVarString($dc_produto);
    }
    function getId_produto() {
        return $this->id_produto;
    }

    function setId_produto($id_produto) {
        $this->id_produto = $this->filterVarInt($id_produto);
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
    
    function getCd_produto_cliente() {
        return $this->cd_produto_cliente;
    }

    function setCd_produto_cliente($cd_produto_cliente) {
        $this->cd_produto_cliente = $this->filterVarInt($cd_produto_cliente);
    }
        
    function getProdutos(){
        $sql = "SELECT p.id_produto,p.dc_produto,p.id_promocao,e.no_embalagem,p.qt_embalagem,p.nm_valor,p.nm_estoque,cd_produto_cliente,".
                " FORMAT(p.nm_valor - (p.nm_valor * p.nm_porcentagem / 100),2) as nm_valor_venda,".
                " (SELECT CONCAT(f.id_foto,'.',f.dc_extensao) FROM produto_foto pf ".
                " INNER JOIN foto f ON pf.id_foto = f.id_foto ".
                " WHERE pf.id_produto = p.id_produto ORDER BY id_capa DESC,f.id_foto ASC LIMIT 1) as foto".
                " FROM produto p LEFT JOIN embalagem e ON p.id_embalagem = e.id_embalagem"
                . " WHERE p.id_status = 1".
                " ORDER BY (SELECT count(pfo.id_foto) FROM produto_foto pfo WHERE pfo.id_produto = p.id_produto) DESC, p.dc_produto ASC ";
        if($this->getNm_limite()) {
            $sql .= " LIMIT {$this->getNm_limite()} ";
        }
        if($this->getNm_offset()) {
            $sql .= " OFFSET {$this->getNm_offset()} ";
        }
        $sql .= ";";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
    function getProdutosPromocao(){
        $sql = "SELECT p.id_produto,p.dc_produto,p.id_promocao,e.no_embalagem,p.qt_embalagem,p.nm_valor,p.nm_estoque,cd_produto_cliente,".
                " FORMAT(p.nm_valor - (p.nm_valor * p.nm_porcentagem / 100),2) as nm_valor_venda,".
                " (SELECT CONCAT(f.id_foto,'.',f.dc_extensao) FROM produto_foto pf ".
                " INNER JOIN foto f ON pf.id_foto = f.id_foto ".
                " WHERE pf.id_produto = p.id_produto ORDER BY id_capa DESC,f.id_foto ASC LIMIT 1) as foto".
                " FROM produto p LEFT JOIN embalagem e ON p.id_embalagem = e.id_embalagem".
                " WHERE p.id_promocao = 1 AND p.id_status = 1 ".
                " ORDER BY (SELECT count(pfo.id_foto) FROM produto_foto pfo WHERE pfo.id_produto = p.id_produto) DESC, p.dc_produto ASC ";
        if($this->getNm_limite()) {
            $sql .= " LIMIT {$this->getNm_limite()} ";
        }
        if($this->getNm_offset()) {
            $sql .= " OFFSET {$this->getNm_offset()} ";
        }
        $sql .= ";";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
    function getProdutosCategoria(){
        $sql = "SELECT p.id_produto,p.dc_produto,p.id_promocao,e.no_embalagem,p.qt_embalagem,p.nm_valor,p.nm_estoque,cd_produto_cliente,".
                " FORMAT(p.nm_valor - (p.nm_valor * p.nm_porcentagem / 100),2) as nm_valor_venda,".
                " (SELECT CONCAT(f.id_foto,'.',f.dc_extensao) FROM produto_foto pf ".
                " INNER JOIN foto f ON pf.id_foto = f.id_foto ".
                " WHERE pf.id_produto = p.id_produto ORDER BY id_capa DESC,f.id_foto ASC LIMIT 1) as foto".
                " FROM produto p LEFT JOIN embalagem e ON p.id_embalagem = e.id_embalagem".
                " WHERE p.id_categoria = ? AND p.id_status = 1 ".
                " ORDER BY (SELECT count(pfo.id_foto) FROM produto_foto pfo WHERE pfo.id_produto = p.id_produto) DESC, p.dc_produto ASC ";
        if($this->getNm_limite()) {
            $sql .= " LIMIT {$this->getNm_limite()} ";
        }
        if($this->getNm_offset()) {
            $sql .= " OFFSET {$this->getNm_offset()} ";
        }
        $sql .= ";";
        $params = array($this->getId_categoria());
        $res = $this->query($sql,$params);
        return $res->fetchAll();
    }
    function search(){
        $sql = "SELECT p.id_produto,p.dc_produto,p.id_promocao,e.no_embalagem,p.qt_embalagem,p.nm_valor,p.nm_estoque,cd_produto_cliente,".
                " FORMAT(p.nm_valor - (p.nm_valor * p.nm_porcentagem / 100),2) as nm_valor_venda,".
                " (SELECT CONCAT(f.id_foto,'.',f.dc_extensao) FROM produto_foto pf ".
                " INNER JOIN foto f ON pf.id_foto = f.id_foto ".
                " WHERE pf.id_produto = p.id_produto ORDER BY id_capa DESC,f.id_foto ASC LIMIT 1) as foto".
                " FROM produto p LEFT JOIN embalagem e ON p.id_embalagem = e.id_embalagem".
                " WHERE p.id_status = 1 AND (p.dc_produto LIKE ? OR p.cd_produto_cliente LIKE ?) ".
                " ORDER BY (SELECT count(pfo.id_foto) FROM produto_foto pfo WHERE pfo.id_produto = p.id_produto) DESC, p.dc_produto ASC;";
        if(empty($this->getCd_produto_cliente())){
            $params = array("%{$this->getDc_produto()}%","%{$this->getDc_produto()}%");
        } else {
            $params = array("%{$this->getDc_produto()}%","%{$this->getCd_produto_cliente()}%");
        }
        $res = $this->query($sql,$params);
        return $res->fetchAll();
    }
    function getProduto(){
        $sql = "SELECT p.id_produto,p.dc_produto,p.id_promocao,p.id_categoria,p.dc_descricao,p.nm_estoque,cd_produto_cliente,"
                . "e.no_embalagem,p.qt_embalagem,p.nm_valor,".
                " FORMAT(p.nm_valor - (p.nm_valor * p.nm_porcentagem / 100),2) as nm_valor_venda,".
                " DATE_FORMAT(p.dt_exp_promocao,'%d/%m/%Y %H:%ihs') as dt_exp_promocao,".
                " (SELECT CONCAT(f.id_foto,'.',f.dc_extensao) FROM produto_foto pf ".
                " INNER JOIN foto f ON pf.id_foto = f.id_foto ".
                " WHERE pf.id_produto = p.id_produto ORDER BY id_capa DESC,f.id_foto ASC LIMIT 1) as foto".
                " FROM produto p LEFT JOIN embalagem e ON p.id_embalagem = e.id_embalagem".
                " WHERE p.id_produto = ? AND p.id_status = 1;";
        $params = array($this->getId_produto());
        $res = $this->query($sql,$params);
        return $res->fetch();
    }
    function getTotalProdutos(){
        $sql = "SELECT count(id_produto) as total FROM produto ";
        if($this->getId_categoria()){
            $sql .= " WHERE id_categoria = ? AND id_status = 1";
            $params = array($this->getId_categoria());
            $res = $this->query($sql, $params);
        } else {
            $res = $this->query($sql);
        }
        $row = $res->fetch();
        return $row['total'];
    }
}
