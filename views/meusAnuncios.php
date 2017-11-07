<?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])): ?>
<div class="container-fluid">
    <div class="jumbotron">
        <h4>Meus Anuncios</h4>
    </div>
    <?php if ( $confirme == "excluir" ) :?>
            <div class="alert-success">
                <strong>Anuncio Excluido!</strong>
            </div>
    <?php endif; ?>
    <form action="<?php echo BASE_URL; ?>produto/addAnuncio/" method="POST">
        <input type="submit" class="btn-default" value="Adicionar Anuncio">
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <?php foreach ($anuncios as $anuncio): ?>
        <tr>
            <td>
                <?php if (!empty($anuncio['url'])) :?>
                <img src="<?php echo BASE_URL; ?>upload/<?php echo($anuncio['url']); ?>" border="0" height="50"/>
                <?php else : ?>
                    <img src="<?php echo BASE_URL; ?>upload/minimagem.jpg" border="0" height="50"/>
                <?php endif; ?>
            </td>
            <td><?php echo ($anuncio['titulo']); ?></td>
            <td><?php echo (number_format($anuncio['valor'],2)); ?></td>
            <td>
                <a href="<?php echo BASE_URL; ?>produto/editarAnuncio/<?php echo($anuncio['id']); ?>" class="btn btn-info">
                    Editar
                </a>
                <a href="<?php echo BASE_URL; ?>produto/excluirAnuncio/<?php echo($anuncio['id']); ?>" class="btn btn-danger">
                    Excluir
                </a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    <br>
    <br>
    <br>
    <br>
</div>
<?php else: ?>
<script type="text/javascript" >window.location.href="./index.php?pag=login"; </script>
<?php endif; ?>