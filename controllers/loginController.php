<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginController
 *
 * @author Daniel_Caldeira
 */
class loginController extends controller{
    //put your code here
    public function index() {
        $dados = array();
        $this->loadTemplate("login", $dados);
    }
    
    private function verificarToken($token) {
        $userToken = new usuarios_token();
        
        $userToken->setHash($token);
        $userToken->selecionarToken();
        if ($userToken->numRows() > 0){
            $result = $userToken->result();
            $id = $result['id_usuario'];
        } else {
            $id = intval('-1');//echo "Token inválido ou usado!";
        }
        return $id;
    }
    
    private function utilizarToken($token) {
        $userToken = new usuarios_token();
        
        $userToken->setHash($token);
        $userToken->setUsado(1);
        $userToken->atualizarUsado();
    }
    
    private function criarToken($id, $token) {
        $userToken = new usuarios_token();
        $expirado_em = date('Y-m-d H:i', strtotime('+2 months'));
        
        $userToken->setIDUsuario($id);
        $userToken->setHash($token);
        $userToken->setExpiradoEm($expirado_em);
        $userToken->incluirUsuariosToken();
    }
    
    private function atualizarUserSenha($id, $senha) {
        $user = new usuario();
        
        $user->setSenha($senha);
        $user->setID($id);
        $user->atualizarSenha();
    }
    
    public function redefinir($token = "") {
        //$userToken = new usuarios_token();
        $dados = array();
        if( !empty($_POST['senha']) ) {
            //$token = $_GET['token'];
            
            $id = $this->verificarToken($token);
            //$userToken->setHash($token);
            //$userToken->selecionarToken();
            
            if($id > 0) {
                
                //$result = $userToken->result();
                //$id = $result['id_usuario'];
                
                if( !empty($_POST['senha']) ) {
                    $senha = $_POST['senha'];
                    
                    $this->atualizarUserSenha($id, $senha);
                    //$user = new usuario();
                    //$user->setSenha($senha);
                    //$user->setID($id);
                    //$user->atualizarSenha();
                    
                    $this->utilizarToken($token);
                    //$userToken->setHash($token);
                    //$userToken->setUsado(1);
                    //$userToken->atualizarUsado();
                    
                    //echo "Senha alterada com sucesso!";
                    //header("Location: ../index.php?pag=redefinir&sucess=true");
                    //$link = BASE_URL."login/redefinir/".$token;
                    //$dados = array();
                    $dados["sucess"] = "true";
                    //$dados["link"] = $link;
                    //$dados["token"] = $token;
                    //$this->loadTemplate("redefinir", $dados);
                    //exit();
                } else {
                    //echo "Informe uma senha valida!";
                    //header("Location: ../index.php?pag=redefinir&senha=true&token=".$token);
                    //$link = BASE_URL."login/redefinir/".$token;
                    //$dados = array();
                    $dados["senha"] = "true";
                    //$dados["token"] = $token;
                    //$dados["link"] = $link;
                    //$this->loadTemplate("redefinir", $dados);
                    //exit();
                }
            } else {
                //echo "Token inválido ou usado!";
                //header("Location: ../index.php?pag=redefinir&error=true&token=".$token);
                //$link = BASE_URL."login/redefinir/".$token;
                //$dados = array();
                $dados["error"] = "true";
                //$dados["token"] = $token;
                //$dados["link"] = $link;
                //$this->loadTemplate("redefinir", $dados);
                //exit();
            }
        } else {
            //echo "Informe uma senha valida!";
            //header("Location: ../index.php?pag=redefinir&senha=true&token=".$token);
            //$link = BASE_URL."login/redefinir/".$token;
            //$dados = array();
            $dados["redefinir"] = "true";
            //$dados["token"] = $token;
            //$dados["link"] = $link;
            //$this->loadTemplate("redefinir", $dados);
            //exit();
        }
        $link = BASE_URL."login/redefinir/".$token;
        $dados["token"] = $token;
        $dados["link"] = $link;
        $this->loadTemplate("redefinir", $dados);
    }
    
    public function esqueciSenha($error = "") {
        $dados = array();
        $dados["error"] = $error;
        $this->loadTemplate("esqueciSenha", $dados);
    }
    
    private function verificarUserEmail($email) {
        $user = new usuario();
        
        $user->setEmail($email);
        $user->selecionarEmail();
        if ($user->numRows() > 0){
            $result = $user->result();
            $id = $result['id'];
        } else {
            $id = intval('-1');//echo "Token inválido ou usado!";
        }
        return $id;
    }
    
    private function encaminharEsqueciSenha($email) {
        $token = md5(time().rand(0, 99999).rand(0, 99999));
        $link = BASE_URL."login/redefinir/".$token;
        $dados = array();
        
        $id = $this->verificarUserEmail($email);
        if($id > 0) {
            $this->criarToken($id, $token);
            
            $mensagem = "Clique no link para redefinir sua senha:<br/>";
            $mensagem = $mensagem . "<a href='".$link."'>link</a>";
            
            $assunto = "Redefinição de senha";
            
            $headers = 'From: seuemail@seusite.com.br'."\r\n" .
                              'X-Mailer: PHP/'.phpversion();
            
            //mail($email, $assunto, $mensagem, $headers);
            
        //        echo ("<h2>OK! Redefinição de Senha!</h2>");
        //        echo ("<br>");
        //        echo ($assunto);
        //        echo ("<br>");
        //        echo ("<h2>E-Mail: ".$email."</h2>");
        //        echo ("<a href=".$link.">Clique aqui para redefinir senha</a>");
        //        
        //        echo $mensagem;
            
            //$dados = array();
            $dados["redefinir"] = "true";
            //$dados["link"] = $link;
            //$dados["token"] = $token;
        } else {
            //$dados = array();
            $dados["error"] = "true";
            //$dados["token"] = $token;
            //$dados["link"] = $link;
            //$this->loadTemplate("esqueciSenha", $dados);
            //header("Location: ".BASE_URL."login/esqueciSenha/error/");
        }
        $dados["link"] = $link;
        $dados["token"] = $token;
        
        return $dados;
    }
    
    public function sisEsqueciSenha(){
        //$user = new usuario();
        $dados = array();
        
        if(!empty($_POST['email'])) {
            $email = $_POST['email'];
            
            $dados = $this->encaminharEsqueciSenha($email);
            //$id = $this->verificarUserEmail($email);
            //$user->setEmail($email);
            //$user->selecionarEmail();
            //$token = md5(time().rand(0, 99999).rand(0, 99999));
            //$link = BASE_URL."login/redefinir/".$token;
            
            //if($id > 0) {
            //    $this->criarToken($id, $token);
            //    $mensagem = "Clique no link para redefinir sua senha:<br/>";
            //    $mensagem = $mensagem . "<a href='".$link."'>link</a>";
            //    $assunto = "Redefinição de senha";
            //    $headers = 'From: seuemail@seusite.com.br'."\r\n" .
            //                  'X-Mailer: PHP/'.phpversion();
                //mail($email, $assunto, $mensagem, $headers);
            //    echo $mensagem;
            //    $dados = array();
            //    $dados["redefinir"] = "true";
            //    $dados["link"] = $link;
            //    $dados["token"] = $token;
                //print_r($dados);
                //$this->loadTemplate("redefinir", $dados);
            //    header("Location: ".BASE_URL."login/redefinir/".$token);
                //header("Location: ../index.php?pag=esqueciSenha&sucess=true&link=".$link);
                //exit();
            //} else {
            //    $dados = array();
            //    $dados["error"] = "true";
            //    $dados["token"] = $token;
            //    $dados["link"] = $link;
            //    //$this->loadTemplate("esqueciSenha", $dados);
            //    header("Location: ".BASE_URL."login/esqueciSenha/error/");
            //}
        
            if ( isset($dados['error']) ){
                $this->loadTemplate("esqueciSenha", $dados);
            } else {
                $this->loadTemplate("esqueciSenha", $dados);
                //$this->loadTemplate("redefinir", $dados);
            }
            
        }
    }
    
    private function verificarStatus($info) {
        global $config;
        if ($info['status'] == 1){
            $_SESSION['id'] = $info['id'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['email'] = $info['email'];
            $config['connect'] = "connected";
            
            //exit();
            header("Location: ".BASE_URL);
            //$this->loadTemplate("inicial");
        } else {
            //$result = "Usuario desabilitado ou E-Mail Invalido!";
            //header("Location: ".BASE_URL."login/index/true/");
            $dados = array();
            $dados["habilitado"] = "true";
            $this->loadTemplate("login", $dados);
        }
    }
    
    public function logar(){
        $user = new usuario();
        if (isset($_POST['email']) && empty($_POST['email'])==false){
            $email = addslashes($_POST['email']);
            $senha = md5(addslashes($_POST['senha']));
            
            $user->setEmail($email);
            $user->setSenha($senha);
            $user->selecionarEmailSenha();
            
            if ($user->numRows() > 0){
                $dado = $user->result();
                
                $this->verificarStatus($dado);
            } else {
                //$result = "E-mail ou Senha Invalido!";
                //header("Location: ".BASE_URL."login/index/true/");
                $dados = array ();
                $dados["error"] = "true";
                $this->loadTemplate("login", $dados);
            }
        }
    }
}
