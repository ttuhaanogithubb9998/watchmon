<?php
class LogoutRoute extends BaseRoutes{
    private $userCtrl;
    function __construct() {
        parent::__construct();
        $this->loadCtrl('User');
        $this->userCtrl = new UserController();
    }
    
    
    function post (){
        return $this->userCtrl->logout();
      
    }

    function get (){
        return $this->userCtrl->logout();
    }

    
}