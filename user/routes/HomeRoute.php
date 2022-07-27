<?php
class HomeRoute extends BaseRoutes{
    private $homeCtrl;
    function __construct() {
        $this->loadCtrl('Home');
        $this->homeCtrl = new HomeController();
    }
    
    
    
    function run($path=''){
        $this->homeCtrl->index();
    }
}