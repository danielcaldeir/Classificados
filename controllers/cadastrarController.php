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
    public function index($confirme = ""){
        $dados = array(
            "confirme" => $confirme
        );
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
        
        $dados = array(
            "usuarios" => $usuarios
        );
        $this->loadTemplate("gerenciaUsuario", $dados);
    }
    
    public function editarUserControll(){
        // put your code here
        $user = new usuario();
        $id = addslashes($_POST['id']);
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $telefone = addslashes($_POST['telefone']);
        
        //$sql = $pdo->atualizarNomeEmailSenha($id, $nome, $email, $senha);
        $user->setID($id);
        $user->setNome($nome);
        $user->setEmail($email);
        $user->setSenha($senha);
        if(is_null($telefone)){
            $user->setTelefone("");
        } else {
            $user->setTelefone($telefone);
        }
        $user->selecionarEmail();
        $dado = array(
            "id" => $id,
            "nome" => $nome,
            "email" => $email,
            "telefone" => $telefone
        );
        if ($user->numRows() > 1){
            $dados = array(
                "confirme" => "existe",
                "dado" => $dado
            );
            $this->loadTemplate("editarUser", $dados);
        } else {
            $sql = $user->atualizarNomeEmailSenha();
            
            $dados = array(
                "confirme" => "sucess",
                "dado" => $dado
            );
            $this->loadTemplate("editarUser", $dados);
        }
    }
    
    public function addUser(){
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

                if(is_null($telefone)){
                    $user->setTelefone("");
                } else {
                    $user->setTelefone($telefone);
                }

                $user->selecionarEmail();
                if ($user->numRows() == 0){
                    $array = $user->incluirNomeEmailSenha();

                    //$array = $pdo->incluirNomeEmailSenha($nome, $email, $senha);
                    //print_r($pdo->result());
                    //echo ("<br>");
                    //print_r($array);

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

                    //header("Location: ../index.php?pag=cadastrar&sucess=true&link=".$link);
                    $dados = array(
                        "confirme" => "sucess",
                        "link" => $link
                    );
                    $this->loadTemplate("cadastrar", $dados);
                    //exit();
                } else {
                    //header("Location: ../index.php?pag=cadastrar&existe=true");
                    $dados = array(
                        "confirme" => "existe"
                    );
                    $this->loadTemplate("cadastrar", $dados);
                }

            } else {
                //header("Location: ../index.php?pag=cadastrar&error=true");
                $dados = array(
                    "confirme" => "error"
                );
                $this->loadTemplate("cadastrar", $dados);
            }
        } else{
            //header("Location: ../index.php?pag=cadastrar&error=true");
            $dados = array(
                "confirme" => "error"
            );
            $this->loadTemplate("cadastrar", $dados);
        }
    }
    
    public function confirmarEmail($token, $confirme = ""){
        $dados = array(
            "token" => $token,
            "confirme" => $confirme
        );
        $this->loadTemplate("confirmarEmail", $dados);
    }
    
    public function editarUser($id, $confirme = ""){
        $user = new usuario();
        $user->setID($id);
        $user->selecionarUser($id);
        
        if ($user->numRows() > 0) {
            $dado = $user->result();
            
            $dados = array(
                "dado" => $dado,
                "confirme" => $confirme
            );
        }else{
            //header("Location: gerenciaUsuario.php");
            $dados = array(
                "dado" => "",
                "confirme" => $confirme
            );
        }
        
        $this->loadTemplate("editarUser", $dados);
    }
    
    public function sisConfirmarEmail(){
        $h = $_POST['h'];
        if (!empty($h)){
            //$pdo = new conexao();
            $user = new usuario();
            $user->setID($h);

            //$pdo->confirmarEmail($h);
            $count = $user->confirmarEmail($h);

            if ($count){
                //echo ("<h2>Cadastro Confirmado com sucesso!</h2>");
                //echo ("<a href=sisAcesso.php> Voltar!! </a>");
                //header("Location: ../index.php?pag=confirmarEmail&sucess=true");
                $dados = array(
                    "confirme" => "sucess"
                );
                $this->loadTemplate("confirmarEmail", $dados);
                //exit();
            } else {
                //echo ("<h2>Cadastro Nao Confirmado ou utilizado!</h2>");
                //echo ("<a href=sisAcesso.php> Voltar!! </a>");
                //header("Location: ../index.php?pag=confirmarEmail&error=true");
                $dados = array(
                    "confirme" => "error"
                );
                $this->loadTemplate("confirmarEmail", $dados);
                //exit();
            }
        } else {
            //header("Location: ../index.php?pag=cadastrar&error=true");
            $dados = array(
                "confirme" => "error"
            );
            $this->loadTemplate("cadastrar", $dados);
            //exit();
        }
    }
}
