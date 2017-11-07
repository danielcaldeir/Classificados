<?php
require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of anuncios
 *
 * @author Daniel_Caldeira
 */
class anunciosImagens extends conexao{
    private $id;
    private $id_anuncio;
    private $url;
    
    public function incluirAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $dados = array (
            "id_anuncio" => $this->id_anuncio,
            "url" => $this->url
        );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function selecionarAnunciosID(){
        $tabela = "anuncios_imagens";
        $colunas = array ("id", "id_anuncio", "url");
        $where = array(
            "id" => $this->id
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function selecionarAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $colunas = array ("id", "id_anuncio", "url");
        $where = array(
            "id_anuncio" => $this->id_anuncio
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function deletarAnunciosID(){
        $tabela = "anuncios_imagens";
        $where = array( 
            "id" => $this->id 
        );
        $this->delete($tabela, $where);
        return null;
    }
    
    public function deletarAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $where = array( 
            "id_anuncio" => $this->id_anuncio 
        );
        $this->delete($tabela, $where);
        return null;
    }
    
    public function atualizarAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $dados = array (
            "url" => $this->url
        );
        $where = array (
            "id_anuncio" => $this->id_anuncio
        );
        $this->update($tabela, $dados, $where);
    }
    
    //put your code here
    public function setID($id) {
        $this->id = $id;
    }
    public function getID() {
        return $this->id;
    }
    
    public function setIDAnuncio($id_anuncio) {
        $this->id_anuncio = $id_anuncio;
    }
    public function getIDAnuncio() {
        return $this->id_anuncio;
    }
    
    public function setURL($url) {
        $this->url = $url;
    }
    public function getURL() {
        return $this->url;
    }
}
