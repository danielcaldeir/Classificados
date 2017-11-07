
<div class="container-fluid">
    <div class="jumbotron">
        <h2>Nos temos hoje <?php echo ($totAnuncios); ?> anuncios</h2>
        <p>E temos <?php echo($totUsuarios); ?> usuarios cadastrados</p>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <h4>Pesquisa Avançada</h4>
            <form action="<?php echo BASE_URL; ?>" method="GET">
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="filtros[categoria]" class="form-control">
                        <option value=""></option>
                        <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo($cat['id']);?>" 
                            <?php if ($cat['id']==$filtros['categoria']) {echo('selected');} ?>>
                                <?php echo($cat['nome']);?>
                        </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <select id="preco" name="filtros[preco]" class="form-control">
                        <option value=""></option>
                        <option value="0-50" <?php if ($filtros['preco']=='0-50'){ echo('selected'); } ?>>
                            R$ 0 a R$ 50
                        </option>
                        <option value="51-100" <?php echo ($filtros['preco']=='51-100')?'selected':''; ?>>
                            R$ 51 a R$ 100
                        </option>
                        <option value="101-500" <?php echo ($filtros['preco']=='101-500')?'selected':''; ?>>
                            R$ 101 a R$ 500
                        </option>
                        <option value="501-()" <?php echo ($filtros['preco']=='501-()')?'selected':''; ?>>
                            R$ 501 ou mais
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado de Conservação:</label>
                    <select id="estado" name="filtros[estado]" class="form-control">
                        <option value=""></option>
                        <option value="2" <?php echo ($filtros['estado']=='2')?'selected':''; ?>>Otimo</option>
                        <option value="1" <?php echo ($filtros['estado']=='1')?'selected':''; ?>>Bom</option>
                        <option value="0" <?php echo ($filtros['estado']=='0')?'selected':''; ?>>Ruim</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-info" value="Buscar"/>
                </div>
            </form>
        </div>
        <div class="col-sm-9">
            <h4>Ultimos Anuncios</h4>
            <table class="table table-striped">
                <tbody>
                    <?php foreach ($result as $value) :?>
                    <tr>
                        <td>
                            <?php if (!empty($value['url'])) :?>
                            <img src="<?php echo BASE_URL; ?>upload/<?php echo($value['url']); ?>" border="0" height="50"/>
                            <?php else : ?>
                                <img src="<?php echo BASE_URL; ?>upload/minimagem.jpg" border="0" height="50"/>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>produto/abrir/<?php echo($value['id']);?>">
                                <?php echo($value['titulo']);?>
                            </a><br>
                            <?php echo($value['categoria']);?>
                        </td>
                        <td><?php echo (number_format($value['valor'],2)); ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php for ($q = 1; $q <= $totalPag; $q++) :?>
                <li class="<?php if($refat==$q){echo('active');}?>">
                <!--    <form action="./index.php" method="GET">                                                          -->
                <!--        <input type="hidden" name="filtros[categoria]" value="<?php echo($filtros['categoria']);?>">  -->
                <!--        <input type="hidden" name="filtros[preco]" value="<?php echo($filtros['preco']);?>">          -->
                <!--        <input type="hidden" name="filtros[estado]" value="<?php echo($filtros['estado']);?>">        -->
                <!--        <input type="hidden" name="refat" value="<?php echo($q);?>">                                  -->
                <!--        <input type="submit" value="<?php echo($q);?>">                                               -->
                <!--    </form>                                                                                           -->
                    <a href="./index.php?<?php 
                    $url = $_GET;
                    $url['refat'] = $q;
                    $url['pag'] = 'inicial';
                    echo(http_build_query($url));
                    ?>">
                        <?php echo($q);?>
                    </a>
                </li>
                <?php endfor;?>
            </ul>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>