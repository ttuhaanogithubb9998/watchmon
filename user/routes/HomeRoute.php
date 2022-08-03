<?php
class HomeRoute extends BaseRoutes{
    private $homeCtrl;
    function __construct() {
        $this->loadCtrl('Home');
        $this->homeCtrl = new HomeController();
    }
    
    
    
    
    
    function get(){
        
        $this->homeCtrl->index();
    }

    function post(){

    }
}