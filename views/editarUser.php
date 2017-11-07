<?php
//session_start();
//require ('conexao.php');
//require_once ('../model/usuario.php');

/* 
 * To change this license header, choose License Headers in Project Properties.

 *  * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$pdo = new conexao();
//$con = $pdo->conecte();
//$user = new usuario();

//if (isset($_GET['id']) && empty($_GET['id'])==false){
//    $id = addslashes($_GET['id']);
//    
//    $user->setID($id);
//    $user->selecionarUser($id);
    //$sql = $pdo->selecionar($id);
    //if ($pdo->numRows() > 0) {
//    if ($user->numRows() > 0) {
        //$dado = $pdo->result();
//        $dado = $user->result();
//    }else{
//        header("Location: gerenciaUsuario.php");
//    }
//}else{
//    header("Location: gerenciaUsuario.php");
//}

//if (isset($_POST['id']) && empty($_POST['id'])==false){
//    $id = addslashes($_POST['id']);
//    $nome = addslashes($_POST['nome']);
//    $email = addslashes($_POST['email']);
//    $senha = addslashes($_POST['senha']);
//    $telefone = addslashes($_POST['telefone']);
    
    //$sql = $pdo->atualizarNomeEmailSenha($id, $nome, $email, $senha);
//    $user->setID($id);
//    $user->setNome($nome);
//    $user->setEmail($email);
//    $user->setSenha($senha);
//    $user->setTelefone($telefone);
//    $sql = $user->atualizarNomeEmailSenha();
//    header("Location: gerenciaUsuario.php");
//}
?>
<!--
<!--    <form method="POST">
<!--        Nome:
<!--        <input type="text" name="nome"  value="<?php echo($dado['nome']);?>"><br>
<!--        E-Mail:
<!--        <input type="text" name="email" value="<?php echo($dado['email']);?>"><br>
<!--        Senha:
<!--        <input type="password" name="senha" value=""><br>
<!--        <input type="hidden" name="id" value="<?php echo($dado['id']);?>">
<!--        <input type="submit" id="botaoEnviarForm" value="Editar">
<!--    </form>
-->
<div class="container-fluid">
    <div class="jumbotron">
        <h4>Editar Usuario</h4>
    </div>
    <?php if ( $confirme == "error" ) :?>
            <div class="alert-warning">
                <label>Preencha todos os Campos</label>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "existe" ) :?>
            <div class="alert-warning">
                <label>Duplicidade de E-Mail!</label><br>
                <a href="<?php echo BASE_URL; ?>login/">Faca o login.</a>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "sucess" ) :?>
            <div class="alert-success">
                <strong>Parabens Usuario Editado com Sucesso!</strong>
            </div>
    <?php endif; ?>
    <form action="<?php echo BASE_URL; ?>cadastrar/editarUserControll" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo($dado['nome']);?>"/>
        </div>
        <div class="form-group">
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo($dado['email']);?>"/>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo($dado['telefone']);?>"/>
        </div>
        <input type="hidden" name="id" value="<?php echo($dado['id']);?>">
      <?php if ( $confirme == "sucess" ) :?>
        <input type="submit" id="botaoEnviarForm" value="Editar" class="btn-default" disabled="true"/>
      <?php else :?>
        <input type="submit" id="botaoEnviarForm" value="Editar" class="btn-default"/>
      <?php endif;?>
        
    </form>
    <br/>
    <br/>
    <br/>
    <br/>
</div>