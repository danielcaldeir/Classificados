<?php
require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of post
 *
 * @author Daniel_Caldeira
 */
class Post extends conexao{
    //put your code here
    private $titulo;
    private $data;
    private $corpo;
    private $autor;
    private $id;
    
    public function incluirPost($post=null){
        try {
            $titulo = $this->titulo;
            $data = $this->data;
            $corpo = $this->corpo;
            $autor = $this->autor;
            
            $sql = "INSERT INTO posts SET titulo='$titulo', data_criado=now(), corpo='$corpo', autor='$autor'";
            $query = $this->pdo->query($sql);
            return $this->pdo->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function deletarPost($id){
        try {
            $tabela = "posts";
            $where = array(
                "id" => $id
            );
            $this->delete($tabela, $where);
            //$sql = "DELETE FROM posts where id = '$id'";
            return null;//$this->pdo->query($sql);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function selecionarALLPosts(){
        try {
            $sql = "SELECT * FROM posts";
            $query = $this->pdo->query($sql);
            $this->numRows = $query->rowCount();
            $this->array = $query->fetchAll();
            return $this->result();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function selecionarPosts(){
        
        $id = $this->id;
        $titulo = $this->titulo;
        $data = $this->data;
        $corpo = $this->corpo;
        $autor = $this->autor;
        
        if (is_null($id)){
            $sql = "SELECT id, titulo, data_criado, corpo, autor FROM posts WHERE autor = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array($autor));
            $this->numRows = $stmt->rowCount();
            $this->array = $stmt->fetchALL();
        } else {
            $sql = "SELECT id, titulo, data_criado, corpo, autor FROM posts where id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $this->numRows = $stmt->rowCount();
            $this->array = $stmt->fetch();
        }
        
        return $this->result();
    }
        
    public function setTitulo($titulo){
        if (is_string($titulo)){
            $this->titulo = $titulo;
        }
    }
    
    public function getTitulo() {
        return $this->titulo;
    }
    
    public function setData($data){
        $this->data = $data;
    }
    
    public function getData() {
        return $this->data;
    }
    
    public function setCorpo($corpo){
        if (is_string($corpo)){
            $this->corpo = $corpo;
        }
    }
    
    public function getCorpo() {
        return $this->corpo;
    }
    
    public function setAutor($autor){
        if (is_string($autor)) {
            $this->autor = $autor;
        }
    }
    
    public function getAutor() {
        return $this->autor;
    }
    
    public function setID($id){
        if (is_string($id)) {
            $this->id = $id;
        }
    }
    
    public function getID() {
        return $this->id;
    }
}
