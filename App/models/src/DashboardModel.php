<?php
namespace App\models;
use Framework\core\Model;
class DashboardModel extends Model {

    function __construct() {
        parent::__construct();
    }
    
    function getDados(){
        $sql = "SELECT * FROM dashboard;";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
    function getPedidosUltMeses(){
        $sql =  "SELECT MONTH(p.dt_pedido) as mes, YEAR(p.dt_pedido) as ano, count(*) as qtd".
                " FROM pedido p".
                " WHERE p.id_status = 1 AND p.dt_pedido > DATE_SUB(now(), INTERVAL 6 MONTH)".
                " GROUP BY YEAR(p.dt_pedido), MONTH(p.dt_pedido) ASC;";
        
        $res = $this->query($sql);
        return $res->fetchAll();
    }
    function getQtCategoria(){
        $sql = "SELECT c.no_categoria, count(*) as qtd "
            ." FROM produto p INNER JOIN categoria c "
            ." ON p.id_categoria = c.id_categoria "
            ." WHERE id_promocao = 1 "
            ." GROUP BY c.id_categoria;";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
     function getQtMarca(){
         $sql = "SELECT m.no_marca,count(*) as qtd ".
                " FROM produto p INNER JOIN marca m ".
                " ON p.id_marca = m.id_marca ".
                " WHERE id_promocao = 1 ".
                " GROUP BY m.id_marca;";
        $res = $this->query($sql);
        return $res->fetchAll();
     }

}
