<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php global $config; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Classificados MVC</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>asserts/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>asserts/css/style.css" />
        <script type="text/javascript" src="<?php echo BASE_URL; ?>asserts/js/jquery-3.2.1.js" ></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>asserts/js/bootstrap.min.js" ></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Classificados</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ( $config['connect'] == "desconnect" ) :?>
                    <div class="alert-warning">
                        <label>Usuario Desconectado!!</label>
                    </div>
                    <?php 
                        //$config['connect'] = "connect";
                    endif; 
                    ?>
                    <?php if ( !empty($_SESSION['id']) ): ?>
                    <li><a href="<?php echo BASE_URL; ?>produto/meusAnuncios/">Meus Anuncios</a></li>
                    <li><a href="<?php echo BASE_URL; ?>home/sair/">Sair</a></li>
                    <?php else : ?>
                    <li><a href="<?php echo BASE_URL; ?>cadastrar/">Cadastra-se</a></li>
                    <li><a href="<?php echo BASE_URL; ?>login/">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <?php
        $this->loadView($viewName, $viewData)
        ?>
        <nav class="navbar navbar-right navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="navbar-text navbar-default">
                    <h3>Página produzida para Analise de Programação</h3>
                </div>
            </div>
        </nav>
    </body>
</html>
