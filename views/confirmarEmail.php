
<div class="container-fluid">
    <div class="jumbotron">
        <label>Confirmar E-Mail</label>
    </div>
    <?php if ( $confirme == "error" ) :?>
            <div class="alert-warning">
                <strong>Cadastro Nao Confirmado ou utilizado!</strong>>
                <a href="<?php echo BASE_URL; ?>login/">
                    Voltar a pagina de Login.
                </a>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "sucess" ) :?>
            <div class="alert-success">
                <strong>Parabens Cadastro Confirmado com sucesso!</strong>
                <a href="<?php echo BASE_URL; ?>login/">
                    Voltar a pagina de Login.
                </a>
            </div>
    <?php endif; ?>
    <form action="<?php echo BASE_URL; ?>cadastrar/sisConfirmarEmail/" method="POST">
        <div class="form-group">
            <label>Aperte Enviar para Confirmar o seu E-Mail!</label>
            <input type="hidden" name="h" value="<?php echo($token); ?>"/>
        </div>
        <input type="submit" name="enviar" value="Enviar" class="btn-default"/>
    </form>
</div>