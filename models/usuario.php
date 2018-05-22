<?php
require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author Daniel_Caldeira
 */
class usuario extends conexao{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $status;
    private $telefone;
    
    public function selecionarEmailSenha(){
        $colunas = array ("id", "nome", "email", "senha", "status", "telefone");
        $tabela = "usuarios";
        $where = array(
            "email" => $this->email,
            "senha" => $this->senha
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
        
    //    try {
    //        $sql = "SELECT * FROM usuarios where email = :email and senha = :senha";
    //        $stmt = $this->pdo->prepare($sql);
    //        $stmt->bindParam(":email", $this->email);
    //        $stmt->bindParam(":senha", $this->senha);
    //        $stmt->execute();
    //        $this->numRows = $stmt->rowCount();
    //        $this->array = $stmt->fetch();
    //        return $this->array;
    //    } catch (Exception $exc) {
    //        echo $exc->getTraceAsString();
    //        echo '<br>';
    //        echo $exc->getMessage();
    //    }
    }
    
    public function selecionarEmail(){
        $tabela = "usuarios";
        $colunas = array ("id", "nome", "email", "senha", "status", "telefone");
        $where = array(
            "email" => $this->email
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function selecionarUser(){
        $tabela = "usuarios";
        $colunas = array ("id", "nome", "email", "senha", "status", "telefone");
        $where = array(
            "id" => $this->id
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function incluirNomeEmailSenha(){
        $tabela = "usuarios";
        $dados = array (
            "nome" => $this->nome,
            "email" => $this->email,
            "senha" => md5($this->senha),
            "status" => 0,
            "telefone" => $this->telefone
        );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function atualizarSenha(){
        $tabela = "usuarios";
        $dados = array (
            "senha" => md5($this->senha)
        );
        $where = array (
            "id" => $this->id
        );
        $this->update($tabela, $dados, $where);
    }
    
    public function atualizarNomeEmailSenha(){
        $tabela = "usuarios";
        $dados = array (
            "nome" => $this->nome,
            "email" => $this->email,
            "senha" => md5($this->senha),
            "telefone" => $this->telefone
        );
        $where = array (
            "id" => $this->id
        );
        $this->update($tabela, $dados, $where);
    }
    
    public function selecionarALLUser(){
        $tabela = "usuarios";
        $colunas = array("id", "nome", "email", "senha", "status", "telefone");
        $this->selecionarTabelas($tabela, $colunas);
        //$sql = "SELECT * FROM usuarios";
        //$this->query($sql);
        return $this->result();
    }
    
    public function confirmarEmail() {
        $tabela = "usuarios";
        $dados = array(
            "status" => '1'
        );
        $where = array(
            "md5(id)" => $this->id
        );
        return $this->update($tabela, $dados, $where);
    }
    
    //put your code here
    public function setID($id) {
        $this->id = $id;
    }
    public function getID() {
        return $this->id;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function getSenha() {
        return $this->senha;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    public function getStatus() {
        return $this->status;
    }
    
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    public function getTelefone() {
        return $this->telefone;
    }
}
