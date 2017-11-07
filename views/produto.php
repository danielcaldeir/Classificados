
<div class="container-fluid">
    <div class="jumbotron">
        <h4>Produto</h4>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="carousel slide" data-ride="carousel" id="meuCarousel">
                <ol class="carousel-indicators">
                    <?php for($x=0;$x<count($fotos);$x++): ?>
                    <li data-target="#meuCarousel" data-slide-to="<?php echo($x);?>" 
                        class="<?php if ($x==0){echo('active');}?>"></li>
                    <?php endfor; ?>
                </ol>
                <div class="carousel-inner" rolr="listbox">
                    <?php foreach ($fotos as $chave => $foto) :?>
                    <div class="item <?php if ($chave =='0') { echo('active'); }?>">
                        <img src="<?php echo BASE_URL; ?>/upload/<?php echo($foto['url']); ?>" border="0" height="50" />
                    </div>
                    <?php endforeach; ?>
                </div>
                <a class="left carousel-control" href="#meuCarousel" role="button" data-slide="prev">
                    <span> < </span>
                </a>
                <a class="right carousel-control" href="#meuCarousel" role="button" data-slide="next">
                    <span> > </span>
                </a>
            </div>
        </div>
        <div class="col-sm-8">
            <h1>Produto: <?php echo($result['titulo']); ?></h1>
            <h4>Categoria: <?php echo($result['categoria']); ?></h4>
            <h4>Descrição: <?php echo($result['descricao']); ?></h4>
            <br><br>
            <h3>R$: <?php echo(number_format($result['valor'], 2)); ?></h3>
        <?php if(empty($user['telefone'])): ?>
            <h4>Telefone: Não há telefone de contato</h4>
        <?php else: ?>
            <h4>Telefone: <?php echo($user['telefone']); ?></h4>
        <?php endif; ?>
            
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>