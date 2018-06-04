<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of produtoController
 *
 * @author Daniel_Caldeira
 */
class produtoController extends controller{
    //put your code here
    public function index() {
        $dados = array ();
                        
        $this->loadTemplate("erro", $dados);
    }
    
    private function selecionarAnunciosImagens($id) {
        $anunImagens = new anunciosImagens();
        $anunImagens->setIDAnuncio($id);
        $fotos = $anunImagens->selecionarAnunciosImagens();
        
        if ($anunImagens->numRows() == 1){
            $fotos = array();
            $fotos[] = $anunImagens->result();
        }
        return $fotos;
    }
    
    private function selecionarCategorias() {
        $cat = new categorias();
        return $cat->selecionarAllCategorias();
    }
    
    private function incluirAnuncios($idUsuario, $titulo, $categoria, $valor, $descricao, $estado) {
        $anuncio = new anuncios();
        $anuncio->setIDUsuario($idUsuario);
        $anuncio->setTitulo($titulo);
        $anuncio->setIDCategoria($categoria);
        $anuncio->setValor($valor);
        $anuncio->setDescricao($descricao);
        $anuncio->setEstado($estado);
        $anuncio->incluirAnuncios();
    }
    
    private function selecionarAnunciosID($idAnuncio) {
        $anuncio = new anuncios();
        $anuncio->setID($idAnuncio);
        return $anuncio->selecionarAnunciosID();
    }
    
    public function addAnuncio() {
        //$c = new categorias();
        //$cats = $c->selecionarAllCategorias();
        $cats = $this->selecionarCategorias();
        $dados = array (
            "cats" => $cats
        );
        $this->loadTemplate("addAnuncio", $dados);
    }
    
    public function adicionarAnuncio() {
        $dados = array ();
        if (isset($_POST['titulo']) && !empty($_POST['titulo'])){
            $usuario = addslashes($_POST['usuario']);
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);

            if (!empty($titulo) && !empty($categoria) && !empty($valor)){
                $this->incluirAnuncios($usuario, $titulo, $categoria, $valor, $descricao, $estado);
                //$anuncio = new anuncios();
                //$anuncio->setIDUsuario($usuario);
                //$anuncio->setTitulo($titulo);
                //$anuncio->setIDCategoria($categoria);
                //$anuncio->setValor($valor);
                //$anuncio->setDescricao($descricao);
                //$anuncio->setEstado($estado);
                //$anuncio->incluirAnuncios();
                
                //exit();
                //header("Location: ../index.php?pag=addAnuncio&sucess=true");
                $dados["sucess"] = "true";
                //exit();
            } else {
                //header("Location: ../index.php?pag=addAnuncio&error=true");
                $dados["error"] = "true";
            }
        } else{
            //header("Location: ../index.php?pag=addAnuncio&error=true");
            $dados["error"] = "true";
        }
        
        //$c = new categorias();
        //$cats = $c->selecionarAllCategorias();
        $cats = $this->selecionarCategorias();
        $dados["cats"] = $cats;
        $this->loadTemplate("addAnuncio", $dados);
    }
    
    public function editarAnuncio($id, $confirme = "") {
        
        $info = $this->selecionarAnunciosID($id);
        //$anuncio = new anuncios();
        //$anuncio->setID($id);
        //$anuncio->selecionarAnunciosID();
        //$info = $anuncio->result();
        
        $fotosArray = $this->selecionarAnunciosImagens($id);
        if (is_array($fotosArray)){
            $fotos = true;
        } else {
            $fotos = false;
        }
        //$anunImagens = new anunciosImagens();
        //$anunImagens->setIDAnuncio($id);
        //$anunImagens->selecionarAnunciosImagens();
        //$fotosArray = array();
        //if ($anunImagens->numRows() == 1){
        //    $fotosArray[] = $anunImagens->result();
        //    $fotos = true;
        //} elseif ($anunImagens->numRows() > 1) {
        //    $fotosArray = $anunImagens->result();
        //    $fotos = true;
        //}else {
        //    $fotos = false;
        //}
        
        //$c = new categorias();
        //$cats = $c->selecionarAllCategorias();
        $cats = $this->selecionarCategorias();
        
        $dados = array();
        $dados["id"] = $id;
        $dados["confirme"] = $confirme;
        $dados["info"] = $info;
        $dados["fotos"] = $fotos;
        $dados["cats"] = $cats;
        $dados["fotosArray"] = $fotosArray;
                        
        $this->loadTemplate("editarAnuncio", $dados);
    }
    
    public function sisEditarAnuncio(){
        if (isset($_POST['id']) && !empty($_POST['id'])){
            $id = addslashes($_POST['id']);
            $usuario = addslashes($_POST['usuario']);
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);
            
            if (isset($_FILES['fotos'])) {
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = array();
            }
            print_r($fotos);
            //exit();

            if (!empty($titulo) && !empty($categoria) && !empty($valor)){
                $anuncio = new anuncios();
                $anuncio->setID($id);
                $anuncio->setIDUsuario($usuario);
                $anuncio->setTitulo($titulo);
                $anuncio->setIDCategoria($categoria);
                $anuncio->setValor($valor);
                $anuncio->setDescricao($descricao);
                $anuncio->setEstado($estado);
                
                $anuncio->atualizarAnuncios();
                
                $fotoCTRL = new fotoController();
                $fotoCTRL->addFoto($fotos);

            //    print "<br><br>Quantidade: ".count($fotos['tmp_name']);
            //    if (count($fotos['tmp_name']) > 0){
            //        $destino = (".\\upload\\");
            //        print "<br><br>";
            //        print_r($destino);
            //        for ($q=0; $q<count($fotos['tmp_name']); $q++){
            //            $tipo = $fotos['type'][$q];
            //            
            //            print "<br><br>";
            //            print_r($tipo);
            //            if (in_array($tipo, array('image/jpg','image/png','image/jpeg'))) {
            //                $nomeFoto = time().rand("0","0.99").$fotos['name'][$q];
            //                move_uploaded_file($fotos['tmp_name'][$q], $destino.$nomeFoto);
            //                print "<br><br>";
            //                print_r($nomeFoto);
            //                list($larguraOriginal, $alturaOriginal) = getimagesize($destino.$nomeFoto);
            //                $ratio = $larguraOriginal / $alturaOriginal;
            //                $largura = "500";
            //                $altura = "500";
            //                if ($largura / $altura > $ratio) {
            //                    $largura = $altura * $ratio;
            //                } else {
            //                    $altura = $largura / $ratio;
            //                }
            //                $imagemFinal = imagecreatetruecolor($largura, $altura);
            //                if ($tipo == "image/jpg"){
            //                    $imageOriginal = imagecreatefromjpeg($destino.$nomeFoto);
            //                } elseif ($tipo == "image/jpeg") {
            //                    $imageOriginal = imagecreatefromjpeg($destino.$nomeFoto);
            //                } elseif ($tipo == "image/png") {
            //                    $imageOriginal = imagecreatefrompng($destino.$nomeFoto);
            //                }
            //                imagecopyresampled($imagemFinal, $imageOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
            //                imagejpeg($imagemFinal, $destino.$nomeFoto,80);
            //                print "<br><br>";
            //                $anunImagens = new anunciosImagens();
            //                $anunImagens->setIDAnuncio($id);
            //                $anunImagens->setURL($nomeFoto);
            //                $anunImagens->incluirAnunciosImagens();
            //            }
            //        }
            //    }
                //exit();
                //header("Location: ../index.php?pag=editarAnuncio&sucess=true&id=".$id);
                header("Location: ".BASE_URL."produto/editarAnuncio/".$id."/sucess");
            } else {
                //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
                header("Location: ".BASE_URL."produto/editarAnuncio/".$id."/error");
            }
        } else{
            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
            header("Location: ".BASE_URL."produto/editarAnuncio/".$id."/error");
        }
        
    }
    
    public function excluirAnuncio($id) {
        $dados = array (
            "id" => $id
        );
        $this->loadTemplate("excluirAnuncio", $dados);
    }
    
    public function sisExcluirAnuncio($id) {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];

            $imagem = new anunciosImagens();
            $imagem->setIDAnuncio($id);
            $imagem->deletarAnunciosImagens();

            $anuncio = new anuncios();
            $anuncio->setID($id);
            $anuncio->deletarAnuncios();

            //header("Location: ../index.php?pag=meusAnuncios&excluir=true");
            $dados = array(
                "confirme" => "excluir"
            );
            $this->loadTemplate("meusAnuncios", $dados);
        } else {
            $dados = array(
                "id" => NULL
            );
            $this->loadTemplate("excluirAnuncio", $dados);
        }
    }
    
    public function meusAnuncios($confirme = "") {
        $a = new anuncios();
        $id_usuario = $_SESSION['id'];
        $a->setIDUsuario($id_usuario);
        $anuncios = $a->selecionarAnuncios();
        if ($a->numRows() == 1){
            $anuncios = array();
            $anuncios[] = $a->result();
        }
        $dados = array (
            "anuncios" => $anuncios,
            "confirme" => $confirme
        );
        $this->loadTemplate("meusAnuncios", $dados);
    }
    
    public function abrir($id) {
        
        if (empty($id)){
            header("Location: ".BASE_URL);
            exit();
        }
        
        $anunImagens = new anunciosImagens();
        $anunImagens->setIDAnuncio($id);
        $fotos = $anunImagens->selecionarAnunciosImagens();
        
        if ($anunImagens->numRows() == 1){
            $fotos = array();
            $fotos[] = $anunImagens->result();
        }
        
        $result = $this->selecionarAnunciosID($id);
        //$anuncio = new anuncios();
        //$anuncio->setID($id);
        //$result = $anuncio->selecionarAnunciosID();
        
        $usuario = new usuario();
        $usuario->setID($result['id_usuario']);
        $user = $usuario->selecionarUser();
        
        $dados = array ();
        $dados["fotos"] = $fotos;
        $dados["result"] = $result;
        $dados["user"] = $user;
        
        $this->loadTemplate("produto", $dados);
    }
}
