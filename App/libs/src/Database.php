<?php
class Database extends PDO{

    function __construct() {
        try{
            parent::__construct(DATABASE_TIPO.":host=".HOST.";dbname=".DATABASE, DBUSER, DBPASS);
        } catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}