<!--
<!--    <pre>
<!--        <?php print_r($_SESSION); ?>
<!--        <?php echo("<hr>");?>
<!--        <?php print_r($dado);?>
<!--        <?php echo("<hr>");?>
<!--        <?php print_r($confirme);?>
<!--    </pre>
-->
<div class="container-fluid">
    <div class="jumbotron">
        <h4>Editar Usuario</h4>
    </div>
    <?php if ( $confirme == "non-existe" ) :?>
            <div class="alert-warning">
                <label>Usuário Inexistente!</label><br>
            </div>
    <?php endif; ?>
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