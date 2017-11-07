<?php
require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarios_token
 *
 * @author Daniel_Caldeira
 */
class usuarios_token extends conexao{
    private $id;
    private $id_usuario;
    private $hash;
    private $usado;
    private $expirado_em;
    
    //put your code here
    
    public function atualizarUsado(){
        $tabela = "usuarios_token";
        $dados = array (
            "usado" => $this->usado
        );
        $where = array (
            "hash" => $this->hash
        );
        $this->update($tabela, $dados, $where);
    }
    
    public function selecionarToken() {
        $tabela = "usuarios_token";
        $colunas = array("id","id_usuario","hash","usado","expirado_em");
        $where = array(
            "hash" => $this->hash,
            "usado" => 0
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function incluirUsuariosToken() {
        $tabela = "usuarios_token";
        $dados = array (
            "id_usuario" => $this->id_usuario,
            "hash" => $this->hash,
            "expirado_em" => $this->expirado_em
        );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function setID($id) {
        $this->id = $id;
    } 
    
    public function setIDUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    
    public function setHash($hash) {
        $this->hash = $hash;
    }
    
    public function setUsado($usado) {
        $this->usado = $usado;
    }
    
    public function setExpiradoEm($expirado_em) {
        $this->expirado_em = $expirado_em;
    }
    
    public function getID() {
        return $this->id;
    } 
    
    public function getIDUsuario() {
        return $this->id_usuario;
    }
    
    public function getHash() {
        return $this->hash;
    }
    
    public function getUsado() {
        return $this->usado;
    }
    
    public function getExpiradoEm() {
        return $this->expirado_em;
    }
}
