<?php
class HomeRoute extends BaseRoutes{
    private $homeCtrl;
    function __construct() {
        parent::__construct();
        $this->loadCtrl('Home');
        $this->homeCtrl = new HomeController();
    }
    
    
    
    

    function post (){
        
    }

    function get (){
        $this->homeCtrl->index();
    }
}