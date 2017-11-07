<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of homeController
 *
 * @author Daniel_Caldeira
 */
class homeController extends controller{
    //put your code here
    
    public function index() {
        
    //    $pag = "inicial";
    //    $result = "";
    //    if (isset($_GET['pag']) && !empty($_GET['pag'])){
    //        $pag=$_GET['pag'];
    //    }
    //    if (isset($_GET['result']) && !empty($_GET['result'])){
    //        $result=$_GET['result'];
    //    }
        
        $refat = 1;
        
        if (isset($_GET['refat']) && !empty($_GET['refat'])){
            $refat = $_GET['refat'];
        }
        
        $qtdPag = 2;
        
        $anuncio = new anuncios();
        
        $filtros = array(
            'categoria' => '',
            'preco' => '',
            'estado' => ''
        );
        
        if (isset($_GET['filtros'])){
            $filtros = $_GET['filtros'];
            if (!empty($filtros['categoria'])){
                $anuncio->setIDCategoria($filtros['categoria']);
            }
            if (!empty($filtros['preco'])){
                $preco = explode("-", $filtros['preco']);
                //print_r($preco);
                $anuncio->setValor($preco);
            }
            if (!empty($filtros['estado'])){
                $anuncio->setEstado($filtros['estado']);
            }
        }
        
        $result = $anuncio->selecionarALLAnuncios($refat, $qtdPag);
        if ($anuncio->numRows() == 1){
            $result = array();
            $result[] = $anuncio->result();
        }
        
        $categoria = new categorias();
        $categorias = $categoria->selecionarAllCategorias();
        if ($categoria->numRows() == 1){
            $categorias = array();
            $categorias[] = $categoria->result();
        }
        
        $usuario = new usuario();
        $usuario->selecionarALLUser();
        $totUsuarios = $usuario->numRows();
        
        $resultQTD = $anuncio->getQTDAnuncios();
        $totAnuncios = $resultQTD['qtd'];
        
        $totalPag = ceil($totAnuncios / $qtdPag);
        
        $dados = array (
            "refat" => $refat,
            "filtros" => $filtros,
            "result" => $result,
            "categorias" => $categorias,
            "totAnuncios" => $totAnuncios,
            "totUsuarios" => $totUsuarios,
            "totalPag" => $totalPag
        );
        
        $this->loadTemplate("inicial", $dados);
    }
    
    public function sair() {
        session_destroy();
        global $config;
        $config['connect'] = "desconnect";
        
        //exit();
        header("Location: ".BASE_URL);
        //$home = new homeController();
        //$home->index();
    }
    
    public function senha($url) {
        echo ("<br>Vamos trocar a senha!!");
        echo ("<br>Nova senha a ser informada: ".$url);
        
    }
    
    public function sobre() {
        $this->loadTemplate("sobre");
    }
    
    public function posts() {
        $posts = new posts();
        
        $dados['posts'] = $posts->selecionarALL();
        
        //print_r($dados);
        //echo ("<br>");
                
        $this->loadTemplate("posts", $dados);
    }
}
