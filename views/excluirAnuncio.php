<?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])): ?>
<div class="container-fluid">
    <div class="small jumbotron">
        <h4>Excluir Anuncios</h4>
    </div>
    
    <?php if ( !empty($id) ) : ?>
        <form action="<?php echo BASE_URL; ?>produto/sisExcluirAnuncio/" method="POST">
            <div class="form-group">
                <label>Tem certeza que deseja excluir o anuncio?</label>
            </div>
            <input type="hidden" name="id" value="<?php echo($id); ?>"/>
            <input type="submit" class="btn btn-success" value="SIM"/>
            <a href="<?php echo BASE_URL; ?>produto/meusAnuncios/" class="btn btn-danger">NÃO</a>
        </form>
    <?php else : ?>
    <form action="<?php echo BASE_URL; ?>produto/meusAnuncios/" method="GET">
        <div class="form-group">
            <label>Não foi informado um identificador.</label>
        </div>
        <input type="submit" class="btn btn-default" value="VOLTAR"/>
    </form>
    
    <?php endif; ?>
    
</div>
<?php else: ?>
<script type="text/javascript" >window.location.href="./index.php?pag=login"; </script>
<?php endif; ?>