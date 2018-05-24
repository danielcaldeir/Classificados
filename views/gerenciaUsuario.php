<!--
<!--
<!--    <pre>
<!--        <?php print_r($_SESSION); ?>
<!--        <?php echo("<hr>");?>
<!--        <?php print_r($usuarios);?>
<!--    </pre>
-->
        <div class="container">
            <div class="dropdown">
                <button class="btn-primary dropdown-toggle" data-toggle="dropdown">
                    Usuarios<span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASE_URL; ?>cadastrar/">Adicionar</a></li>
                    <li><a href="<?php echo BASE_URL; ?>cadastrar/gerenciaUsuario/">Visualizar</a></li>
                    <li><a href='#'>Voltar</a></li>
                </ul>
            </div>
            <a href="<?php echo BASE_URL; ?>cadastrar/">Adicionar novo Usuario</a>
            <table border="1" width="100%" class="table-striped">
                <tr >
                    <th class="text-uppercase text-center">Nome</th>
                    <th class="text-uppercase text-center">E-Mail</th>
                    <th class="text-uppercase text-center">Telefone</th>
                    <th class="text-uppercase text-center">Status</th>
                    <th class="text-uppercase text-center">Açoes</th>
                </tr>
            <?php
            if ( !empty($usuarios) ) :
                foreach ($usuarios as $usuario) :
            ?>
                <tr class="text-center">
                    <td class="text-danger"><?php echo($usuario['nome']); ?></td>
                    <td class="text-info"><?php echo($usuario['email']); ?></td>
                    <td class="text-info"><?php echo($usuario['telefone']); ?></td>
                  <?php if ($usuario['status'] == '1') :?>
                    <td class="text-info">Habilitado</td>
                  <?php else: ?>
                    <td class="text-info">
                        Inabilitado <br/>
                        <a href="<?php echo BASE_URL; ?>cadastrar/confirmarEmail/<?php echo(md5($usuario['id']))?>">Confirmar Mail</a>
                    </td>
                  <?php endif; ?>
                    <td>
                        <button class="btn-success" onclick="window.location.href = '<?php echo BASE_URL; ?>cadastrar/editarUser/<?php echo($usuario['id']); ?>'">Editar</button>
                        <button class="btn-danger" onclick="window.location.href = '<?php echo BASE_URL; ?>cadastrar/excluirUser/<?php echo($usuario['id']); ?>'">Excluir</button>
                        <!--<a href='editarUser.php?id=<?php echo($usuario['id']); ?>'>Editar</a> 
                        - <a href='excluirUser.php?id=<?php echo($usuario['id']); ?>'>Excluir</a>-->
                    </td>
                </tr>
            <?php
                endforeach;
            endif;
            ?>    
            </table>
            <a href="<?php echo BASE_URL; ?>login/">Sistema de Login</a>
        </div>
<br>
<br>
<br>
<br>
<!--
<!--        </body>
<!--    </html>
-->
