<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require ('./enviroment.php');

global $config;
$config = array();
if (ENVIROMENT == "development"){
    define("BASE_URL", "http://localhost/Classificados/");
    $config['dbname'] = "blog";
    $config['host'] = "localhost";
    $config['dbuser'] = "root";
    $config['dbpass'] = "root";
    $config['connect'] = "connect";
} else {
    define("BASE_URL", "http://www.meusite.com.br/");
    $config['dbname'] = "blog";
    $config['host'] = "localhost";
    $config['dbuser'] = "root";
    $config['dbpass'] = "root";
    $config['connect'] = "connect";
}