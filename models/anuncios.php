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
class anuncios extends conexao{
    private $id;
    private $id_usuario;
    private $id_categoria;
    private $titulo;
    private $descricao;
    private $valor;
    private $estado;
    
    public function incluirAnuncios(){
        $tabela = "anuncios";
        $dados = array (
            "id_usuario" => $this->id_usuario,
            "id_categoria" => $this->id_categoria,
            "titulo" => $this->titulo,
            "descricao" => $this->descricao,
            "valor" => $this->valor,
            "estado" => $this->estado
        );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    private function gerenciaWhere(){
        if (!empty($this->id_categoria) && !empty($this->estado) && !empty($this->valor)){
            $preco = $this->valor;
            if ($preco[1]=='()'){
                $where = array(
                    "id_categoria = $this->id_categoria",
                    "valor > $preco[0]",
                    "estado = $this->estado"
                );
            } else {
                $where = array(
                    "id_categoria = $this->id_categoria",
                    "valor BETWEEN $preco[0] and $preco[1]",
                    "estado = $this->estado"
                );
            }
        } elseif (!empty($this->id_categoria) && !empty($this->estado)) {
            $where = array(
                "id_categoria = $this->id_categoria",
                "estado = $this->estado"
            );
        } elseif (!empty($this->id_categoria) && !empty($this->valor)) {
            $preco = $this->valor;
            if ($preco[1]=='()'){
                $where = array(
                    "id_categoria = $this->id_categoria",
                    "valor > $preco[0]"
                );
            } else {
                $where = array(
                    "id_categoria = $this->id_categoria",
                    "valor BETWEEN $preco[0] and $preco[1]"
                );
            }
        } elseif (!empty($this->estado) && !empty($this->valor)) {
            $preco = $this->valor;
            if ($preco[1]=='()'){
                $where = array(
                    "estado = $this->estado",
                    "valor > $preco[0]"
                );
            } else {
                $where = array(
                    "estado = $this->estado",
                    "valor BETWEEN $preco[0] and $preco[1]"
                );
            }
        } elseif (!empty($this->id_categoria)) {
            $where = array(
                "id_categoria = $this->id_categoria"
            );
        } elseif (!empty($this->estado)) {
            $where = array(
                "estado = $this->estado"
            );
        } elseif (!empty($this->valor)) {
            $preco = $this->valor;
            if ($preco[1]=='()'){
                $where = array(
                    "valor > $preco[0]"
                );
            } else {
                $where = array(
                    "valor BETWEEN $preco[0] and $preco[1]"
                );
            }
        } else {
            $where = array();
        }
        return $where;
    }
    
    public function getQTDAnuncios(){
        $tabela = "anuncios";
        $colunas = array ("count(*) as qtd");
        $where = $this->gerenciaWhere();
        $this->selecionarTabelasDifWhere($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function selecionarALLAnuncios($page, $qtdPag){
        $offSet = ($page - 1) * $qtdPag;
        $tabela = "anuncios ";
        $tabela = $tabela."INNER JOIN categorias as cat ON anuncios.id_categoria = cat.id ";
        $colunas = array ("anuncios.id", "id_usuario", "id_categoria", "titulo", "descricao", "valor", 
            "estado", "cat.nome as categoria", 
            "(SELECT imagem.url FROM anuncios_imagens as imagem WHERE imagem.id_anuncio = anuncios.id limit 1) as url");
        $where = $this->gerenciaWhere();
        
        $groupBy = array(
            " ORDER BY anuncios.id DESC ",
            "LIMIT $offSet, $qtdPag"
        );
        $this->selecionarTabelasDifWhere($tabela, $colunas, $where, "AND", $groupBy);
        return $this->result();
    }
    
    public function selecionarAnuncios(){
        $tabela = "anuncios";
        //$colunas = array ("id", "id_usuario", "id_categoria", "titulo", "descricao", "valor", "estado");
        $colunas = array ("id", "id_usuario", "id_categoria", "titulo", "descricao", "valor", "estado",
            "(SELECT imagem.url FROM anuncios_imagens as imagem WHERE imagem.id_anuncio = anuncios.id limit 1) as url");
        $where = array(
            "id_usuario" => $this->id_usuario
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function selecionarAnunciosID(){
        $tabela = "anuncios INNER JOIN categorias as cat ON anuncios.id_categoria = cat.id";
        $colunas = array ("anuncios.id", "anuncios.id_usuario", "anuncios.id_categoria", "anuncios.titulo", 
            "anuncios.descricao", "anuncios.valor", "anuncios.estado", "cat.nome as categoria");
        //$colunas = array ("id", "id_usuario", "id_categoria", "titulo", "descricao", "valor", "estado",
        //    "(SELECT imagem.url FROM anuncios_imagens as imagem WHERE imagem.id_anuncio = anuncios.id limit 1) as url");
        $where = array(
            "anuncios.id" => $this->id
        );
        $this->selecionarTabelas($tabela, $colunas, $where);
        return $this->result();
    }
    
    public function deletarAnuncios(){
        $tabela = "anuncios";
        $where = array( 
            "id" => $this->id 
        );
        $this->delete($tabela, $where);
        return null;
    }
    
    public function atualizarAnuncios(){
        $tabela = "anuncios";
        $dados = array (
            "id_categoria" => $this->id_categoria,
            "titulo" => $this->titulo,
            "descricao" => $this->descricao,
            "valor" => $this->valor,
            "estado" => $this->estado
        );
        $where = array (
            "id" => $this->id,
            "id_usuario" => $this->id_usuario
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
    
    public function setIDUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function getIDUsuario() {
        return $this->id_usuario;
    }
    
    
    public function setIDCategoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }
    public function getIDCategoria() {
        return $this->id_categoria;
    }
    
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setValor($valor) {
        $this->valor = $valor;
    }
    public function getValor() {
        return $this->valor;
    }
    
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getEstado() {
        return $this->estado;
    }
}
