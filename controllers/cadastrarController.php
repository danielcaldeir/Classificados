<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cadastrarController
 *
 * @author Daniel_Caldeira
 */
class cadastrarController extends controller{
    //put your code here
    private function isTelefoneNull($telefone) {
        if(is_null($telefone)){
            $tel = "";
        } else {
            $tel = $telefone;
        }
        return $tel;
    }
    
    private function cadastrarUser(usuario $user) {
        $user->selecionarEmail();
        if ($user->numRows() == 0){
            $array = $user->incluirNomeEmailSenha();
            
            $id = $array['ID'];
            $md5 = md5($id);
            $link = BASE_URL."cadastrar/confirmarEmail/".$md5;
            
            $assunto = "Confirme seu cadastro";
            $msg = "Clique no Link abaixo para confirmar seu cadastro:\n\n".$link;
            $headers = "From: suporte@b7web.com.br"."\r\n"."X-Mailer: PHP/".phpversion();
            
            //mail($email, $assunto, $msg, $headers);
            
            //echo ("<h2>OK! Confirme seu cadastro agora!</h2>");
            //echo ("<br>");
            //echo ($assunto);
            //echo ("<br>");
            //echo ("<h2>Nome: ".$nome."</h2>");
            //echo ("<br>");
            //echo ("<h2>E-Mail: ".$email."</h2>");
            //echo ("<a href=".$link.">Clique aqui para confirmar</a>");
            
            $dados = array();
            $dados["confirme"] = "sucess";
            $dados["link"] = $link;
        } else {
            $dados = array();
            $dados["confirme"] = "existe";
        }
        return $dados;
    }
    
    private function atualizarInfo($id, $nome, $email, $telefone) {
        $info = array();
        $info["id"] = $id;
        $info["nome"] = $nome;
        $info["email"] = $email;
        $info["telefone"] = $telefone;
        
        return $info;
    }
    
    private function selecionarUser($id, $nome, $email, $senha, $telefone) {
        $user = new usuario();
        $dados = array();
        
        $user->setID($id);
        $user->setNome($nome);
        $user->setEmail($email);
        $user->setSenha($senha);
        $tel = $this->isTelefoneNull($telefone);
        $user->setTelefone($tel);
        
        $user->selecionarEmail();
        
        $info = $this->atualizarInfo($id, $nome, $email, $telefone);
        //$info = array();
        //$info["id"] = $id;
        //$info["nome"] = $nome;
        //$info["email"] = $email;
        //$info["telefone"] = $telefone;
        
        if ($user->numRows() > 1){
        //    $dados = array();
            $dados["confirme"] = "existe";
            $dados["dado"] = $info;
            //$this->loadTemplate("editarUser", $dados);
        } else {
            $user->atualizarNomeEmailSenha();
        //    $dados = array();
            $dados["confirme"] = "sucess";
            $dados["dado"] = $info;
            //$this->loadTemplate("editarUser", $dados);
        }
        return $dados;
    }
    
    public function index($confirme = ""){
        $dados = array();
        $dados["confirme"] = $confirme;
        
        $this->loadTemplate("cadastrar", $dados);
    }
    
    public function gerenciaUsuario(){
        // put your code here
        $user = new usuario();
        $usuarios = $user->selecionarALLUser();
        if ($user->numRows() == 1){
            $usuarios = array();
            $usuarios[] = $user->result();
        }
        
        $dados = array();
        $dados["usuarios"] = $usuarios;
        $this->loadTemplate("gerenciaUsuario", $dados);
    }
    
    public function editarUserControll(){
        // put your code here
        //$user = new usuario();
        $id = addslashes($_POST['id']);
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $telefone = addslashes($_POST['telefone']); 
        
        //$sql = $pdo->atualizarNomeEmailSenha($id, $nome, $email, $senha);
        $dados = $this->selecionarUser($id, $nome, $email, $senha, $telefone);
        //$user->setID($id);
        //$user->setNome($nome);
        //$user->setEmail($email);
        //$user->setSenha($senha);
        //$tel = $this->isTelefoneNull($telefone);
        //$user->setTelefone($tel);
    //    if(is_null($telefone)){
    //        $user->setTelefone("");
    //    } else {
    //        $user->setTelefone($telefone);
    //    }
        //$user->selecionarEmail();
        //$info = array( 
        //    "id" => $id, 
        //    "nome" => $nome, 
        //    "email" => $email, 
        //    "telefone" => $telefone 
        //);
        //$dados = $this->editarUsuario($user, $info);
        //if ($user->numRows() > 1){
        //    $dados = array( "confirme" => "existe", "dado" => $dado );
        //    //$this->loadTemplate("editarUser", $dados);
        //} else {
        //    $user->atualizarNomeEmailSenha();
        //    $dados = array( "confirme" => "sucess", "dado" => $dado );
        //    //$this->loadTemplate("editarUser", $dados);
        //}
        $this->loadTemplate("editarUser", $dados);
    }
    
    public function editarUser($id, $confirme = ""){
        $user = new usuario();
        $dados = array();
        
        $user->setID($id);
        $user->selecionarUser();
        
        if ($user->numRows() > 0) {
            $dado = $user->result();
            
        //    $dados = array();
            $dados["dado"] = $dado;
            $dados["confirme"] = $confirme;
        }else{
            //header("Location: gerenciaUsuario.php");
        //    $dados = array();
            $dados["dado"] = "";
            $dados["confirme"] = "non-existe";
        }
        
        $this->loadTemplate("editarUser", $dados);
    }
    
    public function addUser(){
        $dados = array();
        if (isset($_POST['nome']) && empty($_POST['nome'])==false){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $telefone = addslashes($_POST['telefone']);

            if (!empty($nome) && !empty($email) && !empty($senha)){
                $user = new usuario();
                $user->setNome($nome);
                $user->setEmail($email);
                $user->setSenha($senha);
                $tel = $this->isTelefoneNull($telefone);
                $user->setTelefone($tel);

            //    $user->selecionarEmail();
                $dados = $this->cadastrarUser($user);
                //$this->loadTemplate("cadastrar", $dados);
                //if ($user->numRows() == 0){
                //    $array = $user->incluirNomeEmailSenha();
                //    //$array = $pdo->incluirNomeEmailSenha($nome, $email, $senha);
                //    //print_r($pdo->result());
                //    //echo ("<br>");
                //    //print_r($array);
                //    $id = $array['ID'];
                //    $md5 = md5($id);
                //    $link = BASE_URL."cadastrar/confirmarEmail/".$md5;
                //    $assunto = "Confirme seu cadastro";
                //    $msg = "Clique no Link abaixo para confirmar seu cadastro:\n\n".$link;
                //    $headers = "From: suporte@b7web.com.br"."\r\n"."X-Mailer: PHP/".phpversion();
                //    //mail($email, $assunto, $msg, $headers);
                //    //echo ("<h2>OK! Confirme seu cadastro agora!</h2>");
                //    //echo ("<br>");
                //    //echo ($assunto);
                //    //echo ("<br>");
                //    //echo ("<h2>Nome: ".$nome."</h2>");
                //    //echo ("<br>");
                //    //echo ("<h2>E-Mail: ".$email."</h2>");
                //    //echo ("<a href=".$link.">Clique aqui para confirmar</a>");
                //    //header("Location: ../index.php?pag=cadastrar&sucess=true&link=".$link);
                //    $dados = array(
                //        "confirme" => "sucess",
                //        "link" => $link
                //    );
                //    $this->loadTemplate("cadastrar", $dados);
                //    //exit();
                //} else {
                //    //header("Location: ../index.php?pag=cadastrar&existe=true");
                //    $dados = array(
                //        "confirme" => "existe"
                //    );
                //    $this->loadTemplate("cadastrar", $dados);
                //}
            } else { $dados["confirme"] = "error"; }
        } else{ $dados["confirme"] = "error"; }
        $this->loadTemplate("cadastrar", $dados);
    }
    
    public function confirmarEmail($token, $confirme = ""){
        $dados = array();
        $dados["token"] = $token;
        $dados["confirme"] = $confirme;
        
        $this->loadTemplate("confirmarEmail", $dados);
    }
    
    public function sisConfirmarEmail(){
        $h = $_POST['h'];
        if (!empty($h)){
            $user = new usuario();
            $user->setID($h);
            
            $count = $user->confirmarEmail();
            
            if ($count){
                $dados = array();
                $dados["confirme"] = "sucess";
                //$this->loadTemplate("confirmarEmail", $dados);
            } else {
                $dados = array();
                $dados["confirme"] = "error";
                //$this->loadTemplate("confirmarEmail", $dados);
            }
            $this->loadTemplate("confirmarEmail", $dados);
        } else {
            //header("Location: ../index.php?pag=cadastrar&error=true");
            $dados = array();
            $dados["confirme"] = "error";
            $this->loadTemplate("cadastrar", $dados);
        }
    }
}
