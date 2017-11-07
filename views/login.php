        <div class="container-fluid">
            <div class="jumbotron">
                <h2>Página de Login!!</h2>
            </div>
            <?php if (!empty($error)) :?>
            <div class="alert-warning">
                <label>E-mail ou Senha Invalido!</label>
            </div>
            <?php endif; ?>
            <?php if (!empty($habilitado)) :?>
            <div class="alert-warning">
                <label>Usuário Desabilitado ou E-mail Invalido!</label>
            </div>
            <?php endif; ?>
            <form action="<?php echo BASE_URL; ?>login/logar/" method="POST">
                E-Mail:
                <input class="item" type="text" name="email" value=""><br>
                Senha:
                <input class="item" type="password" name="senha" value=""><br>
                <input class="btn-success" type="submit" id="botaoEnviarForm" value="Entrar">
            </form>
            <a href="<?php echo BASE_URL; ?>login/esqueciSenha/">Esqueceu a senha!</a><br>
            <a href="<?php echo BASE_URL; ?>cadastrar/gerenciaUsuario/">Gerenciamento de Usuarios</a>
        </div>
