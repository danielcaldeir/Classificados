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
    private function iniciarFiltros($consultas = null) {
        $filtros = array();
        $filtros['categoria'] = '';
        $filtros['preco'] = '';
        $filtros['estado'] = '';
        if (is_array($consultas)){
            $filtros = $consultas;
        }
        return $filtros;
    }
    
    private function getTemplateDados() {
        $dados = array();
        $cat = new categorias();
        $usuario = new usuario();
        
        $categorias = $cat->selecionarAllCategorias();
        if ($cat->numRows() == 1){
            $categorias = array();
            $categorias[] = $cat->result();
        }
        
        $usuario->selecionarALLUser();
        $totUsuarios = $usuario->numRows();
        
        $dados["categorias"] = $categorias;
        $dados["totUsuarios"] = $totUsuarios;
        
        return $dados;
    }
    
    public function index() {
        //$cat = new categorias();
        $anuncio = new anuncios();
        //$usuario = new usuario();
        
    //    $pag = "inicial";
    //    $result = "";
    //    if (isset($_GET['pag']) && !empty($_GET['pag'])){
    //        $pag=$_GET['pag'];
    //    }
    //    if (isset($_GET['result']) && !empty($_GET['result'])){
    //        $result=$_GET['result'];
    //    }
        
        $refat = 1;
        $qtdPag = 2;
        if (isset($_GET['refat']) && !empty($_GET['refat'])){
            $refat = $_GET['refat'];
        }
        
        if (isset($_GET['filtros'])){
            $filtros = $this->iniciarFiltros($_GET['filtros']);
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
        } else {
            $filtros = $this->iniciarFiltros();
        }
        
        //$filtros = array(
        //    'categoria' => '',
        //    'preco' => '',
        //    'estado' => ''
        //);
        
        //if (isset($_GET['filtros'])){
        //    $filtros = $_GET['filtros'];
        //    if (!empty($filtros['categoria'])){
        //        $anuncio->setIDCategoria($filtros['categoria']);
        //    }
        //    if (!empty($filtros['preco'])){
        //        $preco = explode("-", $filtros['preco']);
        //        //print_r($preco);
        //        $anuncio->setValor($preco);
        //    }
        //    if (!empty($filtros['estado'])){
        //        $anuncio->setEstado($filtros['estado']);
        //    }
        //}
        
        $result = $anuncio->selecionarALLAnuncios($refat, $qtdPag);
        if ($anuncio->numRows() == 1){
            $result = array();
            $result[] = $anuncio->result();
        }
        
        $resultQTD = $anuncio->getQTDAnuncios();
        $totAnuncios = $resultQTD['qtd'];
        
        //$categorias = $cat->selecionarAllCategorias();
        //if ($cat->numRows() == 1){
        //    $categorias = array();
        //    $categorias[] = $cat->result();
        //}
        
        //$usuario->selecionarALLUser();
        //$totUsuarios = $usuario->numRows();
        
        //$totalPag = ceil($totAnuncios / $qtdPag);
        
        $dados = $this->getTemplateDados();
        $dados["refat"] = $refat;
        $dados["filtros"] = $filtros;
        $dados["result"] = $result;
        //$dados["categorias"] = $categorias;
        $dados["totAnuncios"] = $totAnuncios;
        //$dados["totUsuarios"] = $totUsuarios;
        $dados["totalPag"] = ceil($totAnuncios / $qtdPag);
        
        $this->loadTemplate("inicial", $dados);
    }
    
    public function sair() {
        session_destroy();
        global $config;
        $config['connect'] = "desconnect";
        
        //exit();
        //header("Location: ".BASE_URL);
        //$home = new homeController();
        $this->index();
    }
    
    //LoginController
    //public function senha($url) {
    //    echo ("<br>Vamos trocar a senha!!");
    //    echo ("<br>Nova senha a ser informada: ".$url);
    //}
    
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
