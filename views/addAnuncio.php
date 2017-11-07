<?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])): ?>
<div class="container-fluid">
    <div class="small jumbotron">
        <h4>Meus Anuncios - Adicionar Anuncio</h4>
    </div>
    <?php if ( !empty($error) ) :?>
            <div class="alert-warning">
                <label>Preencha todos os Campos</label>
            </div>
    <?php endif; ?>
    <?php if ( !empty($sucess) ) :?>
            <div class="alert-success">
                <strong>Parabens Anuncio Realizado!</strong>
            </div>
    <?php endif; ?>
    <form action="<?php echo BASE_URL; ?>produto/adicionarAnuncio/" method="POST" enctype="multpart/form-data">
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
            <?php 
       //         include_once './model/categorias.php';
       //         $c = new categorias();
       //         $cats = $c->selecionarAllCategorias();
                foreach ($cats as $cat): 
            ?>
                <option value="<?php echo($cat['id']); ?>"> <?php echo($cat['nome']); ?> </option>
            <?php endforeach;?>
                
            </select>
        </div>
        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="descricao">Descricao:</label>
            <textarea name="descricao" id="descricao" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="estado">Estado de Conservacao:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0">Ruim</option>
                <option value="1">Bom</option>
                <option value="2">Otimo</option>
            </select>
        </div>
        <input type="hidden" id="usuario" name="usuario" value="<?php echo($_SESSION['id']); ?>" />
        <input type="submit" id="botaoEnviarForm" value="ADICIONAR" class=" btn btn-default"/>
        <a href="<?php echo BASE_URL; ?>produto/meusAnuncios/" class="btn btn-default">VOLTAR</a>
    </form>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
</div>
<?php else: ?>
<script type="text/javascript" >window.location.href="./index.php?pag=login"; </script>
<?php endif; ?>