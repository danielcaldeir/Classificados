<?php
require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categorias
 *
 * @author Daniel_Caldeira
 */
class categorias extends conexao{
    private $id;
    private $nome;
    
    public function selecionarCategoriasID(){
        $tabela = "categorias";
        $colunas = array ("id", "nome");
        $where = array(
            "id" => $this->id
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function selecionarAllCategorias(){
        $tabela = "categorias";
        $colunas = array ("id", "nome");
        $where = array();
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
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
}
