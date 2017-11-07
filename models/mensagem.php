<?php
require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mensagem
 *
 * @author Daniel_Caldeira
 */
class mensagem extends conexao{
    //put your code here
    private $id;
    private $id_post;
    private $data;
    private $nome;
    private $mensagem;
    
    public function selecionarALLMSG($id = null) {
        try {
            if (is_null($id)){
                $sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
            } else {
                $sql = "SELECT * FROM mensagens WHERE id_posts = '$id' ORDER BY data_msg DESC";
            }
            $this->query($sql);
            return $this->result();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function incluirMSG() {
//        if (is_array($msg)){
            //$id = $this->id;
            $id_post = $this->id_post;
            //$data = $this->data;
            $nome = $this->nome;
            $mensagem = $this->mensagem;
            
//            $id_post = $msg['id_posts'];
//            $nome = $msg['nome'];
//            $mensagem = $msg['msg'];
            
            $sql = "INSERT INTO mensagens SET id_posts=?, data_msg=now(), nome=?, msg=?";
            $stmt = $this->pdo->prepare($sql);
            //print_r($sql);
            $valor = $stmt->execute(array ($id_post, $nome, $mensagem));
            return $valor;
//        }
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    
    public function getID() {
        return $this->id;
    }
    
    public function setIdPost($id_post) {
        $this->id_post = $id_post;
    }
    
    public function getIdPost() {
        return $this->id_post;
    }
    
    public function setData($data) {
        $this->data = $data;
    }
    
    public function getData() {
        return $this->data;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setMSG($msg) {
        $this->mensagem = $msg;
    }
    
    public function getMSG() {
        return $this->mensagem;
    }
}
