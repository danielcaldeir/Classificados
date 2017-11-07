<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author Daniel_Caldeira
 */

class model {
    
    protected $pdo;
    protected $numRows;
    protected $array;
    
    //put your code here
    public function __construct() {
        global $config;
        $dsn = "mysql:dbname=".$config['dbname'].";host=".$config['host'];
        $dbuser = $config['dbuser'];
        $dbpass = $config['dbpass'];
        
        try {
            $this->pdo = new PDO($dsn, $dbuser, $dbpass);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function query($sql){
        $query = $this->pdo->query($sql);
        $this->numRows = $query->rowCount();
        $this->array = $query->fetchALL();
        //echo ("Array: ".$this->array."<br>");
        //echo ("sql: ".$sql."<br>");
    }
    
    public function insert($table, $data){
        if (!empty($table) && (is_array($data) && count($data)>0 ) ){
            $sql = "INSERT INTO ".$table." SET ";
            $dados = array();
            foreach ($data as $chave => $valor) {
                $dados[] = $chave." = '".addslashes($valor)."'";
            }
            $sql = $sql.implode(", ", $dados);
            echo $sql;
            //$this->pdo->query($sql);
        }
    }
    
    public function update($table, $data, $where = array(), $where_cond = "AND"){
        if (!empty($table) && (is_array($data) && count($data)) && is_array($where)){
            $sql = "UPDATE ".$table." SET ";
            $dados = array();
            foreach ($data as $chave => $valor) {
                $dados[] = $chave." = '".addslashes($valor)."'";
            }
            $sql = $sql.implode(", ", $dados);
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $chave => $valor) {
                    $dados[] = $chave." = '".addslashes($valor)."'";
                }
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            echo $sql;
            //$this->pdo->query($sql);
        }
    }
    
    public function delete($table, $data, $where = array(), $where_cond = "AND"){
        if (!empty($table) && (is_array($data) && count($data)) && is_array($where)){
            $sql = "DELETE FROM ".$table;
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $chave => $valor) {
                    $dados[] = $chave." = '".addslashes($valor)."'";
                }
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            echo $sql;
            //$this->pdo->query($sql);
        }
    }
    
    public function numRows(){
        return $this->numRows;
    }
    
    public function result(){
        return $this->array;
    }
}
