<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author Daniel_Caldeira
 */
class controller {
    //put your code here
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include ("views/".$viewName.".php");
    }
    
    public function loadTemplate($viewName, $viewData = array()) {
        include ("views/template.php");
    }
}
