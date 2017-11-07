<h1>Esta e a página das Postagens</h1>

<?php
foreach ($posts as $postagem): 
    $post = new posts();
    $post->setID($postagem['id']);
    $post->setTitulo($postagem['titulo']);
    $post->setData($postagem['data_criado']);
    $post->setAutor($postagem['autor']);
    $post->setCorpo($postagem['corpo']);
?>
<h3>Postagem: <?php echo($post->getTitutlo());?></h3>
<h3>Data Criado: <?php echo($post->getData());?></h3>
<h3>Autor: <?php echo($post->getAutor());?></h3>
<hr>
<?php
endforeach; 
?>
<br>