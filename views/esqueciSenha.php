
<div class="container-fluid">
    <div class="jumbotron">
        <label>Esqueci Senha</label>
    </div>
    <?php if ( !empty($error) ) :?>
            <div class="alert-warning">
                <label>Informe um E-Mail valido!</label>
            </div>
    <?php endif; ?>
    <?php //if ( !empty($sucess) ) :?>
    <?php if ( !empty($redefinir) ) :?>
            <div class="alert-success">
                <strong>Parabens E-Mail Encontrado!</strong>
                <br/>
                <a href="<?php echo($link);?>">
                    Acesse o Link para Realizar o cadastro de uma nova senha.
                </a>
            </div>
    <?php else :?>
    <form action="<?php echo BASE_URL; ?>login/sisEsqueciSenha/" method="POST">
        <div class="form-group">
            <label>Qual seu e-mail?</label>
            <input type="email" name="email" value="@" class="form-control"/><br/>
        </div>
        <input type="submit" value="Enviar" id="botaoEsqSenha" class="btn-default"/>
    </form>
    <?php endif; ?>
</div>
