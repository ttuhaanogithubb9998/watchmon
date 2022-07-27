<?php
class UserRoute extends BaseRoutes{
    private $userCtrl;
    function __construct() {
        $this->loadCtrl('User');
        $this->userCtrl = new UserController();
    }
    
    
    
    function run($path=''){
        $this->userCtrl->index();
    }
}