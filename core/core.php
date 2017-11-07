<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of core
 *
 * @author Daniel_Caldeira
 */

require_once ('./core/controller.php');

class Core {
    //put your code here
    
    private $currentController;
    //private $currentAction;
    
    public function run() {
        //$url = substr($_SERVER['PHP_SELF'], 10);
        $urlExplode = explode("index.php", $_SERVER['PHP_SELF']);
        $url = end($urlExplode);
        
        //print_r($url);//visualizador de URL
        //echo ("<br>");
        
        if (!empty($url)){
            $url = explode('/', $url);
            array_shift($url);
            
            //print_r($url);//variaveis da URL
            //echo ("<br>");
            
            $this->currentController = $url[0].'Controller';
            array_shift($url);
            
            //print_r($url);//variaveis da URL
            //echo ("<br>");
            
            $param = array();
            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
                //print_r($url);//variaveis da URL
                //echo ("<br>");
            } else {
                $currentAction = 'index';
            }
            if ((count($url) > 0) && !empty($url[0])){
                $param = $url;
            }
        } else {
            $this->currentController = 'homeController';
            $currentAction = 'index';
            $param = array();
        }
        
        //echo ("Controller: ".$this->currentController."<br>");//Qual o Controller
        //echo ("Action: ".$currentAction."<br>");//Qual a Action
        //echo ("Param: ");
        //print_r($param);
        //echo ("<br>");//Qual os Parametros
        
        $c = new $this->currentController();
        //$c->$currentAction();
        call_user_func_array(array($c, $currentAction), $param);
    }
}
