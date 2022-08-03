<?php
class UserRoute extends BaseRoutes{
    private $userCtrl;
    function __construct() {
        parent::__construct();
        $this->loadCtrl('User');
        $this->userCtrl = new UserController();
    }
    
    
    
   
    function post (){
        
    }
    function get (){
        $this->userCtrl->index();
    }
    
}