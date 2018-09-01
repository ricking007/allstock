<?php
namespace App\models;
use Framework\core\Model;
class NotificationModel extends Model {
    private $id_notificacao,
            $dc_titulo,
            $dc_mensagem,
            $id_status,
            $id_pessoa,
            $id_pedido,
            $nm_limit;
    function __construct() {
        parent::__construct();
    }
    public function getId_notificacao() {
        return $this->id_notificacao;
    }

    public function setId_notificacao($id_notificacao) {
        $this->id_notificacao = $this->filterVarInt($id_notificacao);
    }

    public function getDc_titulo() {
        return $this->dc_titulo;
    }

    public function setDc_titulo($dc_titulo) {
        $this->dc_titulo = $this->filterVarString($dc_titulo);
    }

    public function getDc_mensagem() {
        return $this->dc_mensagem;
    }

    public function setDc_mensagem($dc_mensagem) {
        $this->dc_mensagem = $dc_mensagem;
    }

    public function getId_status() {
        return $this->id_status;
    }

    public function setId_status($id_status) {
        $this->id_status = $this->filterVarInt($id_status);
    }

    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $this->filterVarInt($id_pessoa);
    }
    public function getId_pedido() {
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido) {
        $this->id_pedido = $this->filterVarInt($id_pedido);
    }
    public function getNm_limit() {
        return $this->nm_limit;
    }

    public function setNm_limit($nm_limit) {
        $this->nm_limit = $this->filterVarInt($nm_limit);
    }

            
    public function set(){
        $sql = "INSERT INTO notificacao (dc_titulo,dc_mensagem,id_pessoa,id_pedido)".
            " VALUES (?,?,?,?)";
        $params = array($this->getDc_titulo(),$this->getDc_mensagem(),
                        $this->getId_pessoa(),$this->getId_pedido());
        $this->query($sql, $params);
        $this->setId_notificacao($this->lastInsertId);
        return $this->lastInsertId;
    }
    
    public function get(){
        $sql = "SELECT n.id_notificacao,n.dc_titulo,n.dc_mensagem,n.id_status,n.id_pessoa,n.id_pedido,"
                ."DATE_FORMAT(n.dt_notificacao,'%d/%m/%Y - %H:%i') as dt_notificacao,"
                ."DATE_FORMAT(n.dt_leitura,'%d/%m/%Y - %H:%i') as dt_leitura,"
                . "p.no_nome_completo as no_lida_por"
                . " FROM notificacao n LEFT JOIN pessoa p ON n.id_pessoa = p.id_pessoa ";
                
        $params = array();
        if($this->getId_status()){
            $sql .= " WHERE id_status = ? ";
            $params[] = $this->getId_status();
        }
        $sql .= "ORDER BY id_notificacao DESC;";
        //exit($sql);
        //print_r($params); exit();
        $res = $this->query($sql, $params);
        return $res->fetchAll();
    }
    public function getNotification(){
        $sql = "SELECT n.id_notificacao,n.dc_titulo,n.dc_mensagem,n.id_status,n.id_pessoa,n.id_pedido,".
               " DATE_FORMAT(n.dt_notificacao,'%d/%m/%Y %H:%i') as dt_notificacao".
               " FROM notificacao n".
               " WHERE n.id_notificacao = ?;";
        //exit($sql);
        $params = array($this->getId_notificacao());
        $res = $this->query($sql, $params);
        $row = $res->fetch();
        if(!empty($row) && $row['id_status'] == 1){ // marca como liga se encontrou a notificacao
            $this->read();
        }
        return $row;
    }
    public function complete(){
        $sql = "UPDATE notificacao SET id_status = 2,dt_leitura = NOW() WHERE id_notificacao = ?";
        $params = array($this->getId_notificacao());
        $res = $this->query($sql, $params);
        return $res->rowCount();
    }
    public function read(){
        $sql = "UPDATE notificacao SET id_status = 2, id_pessoa = ?, dt_leitura = NOW() WHERE id_notificacao = ?;";
        $params = array($this->getId_pessoa(),$this->getId_notificacao());
        $this->query($sql, $params);
    }

    

}