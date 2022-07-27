<?php
class UserController extends BaseController{
    private $userModel;
    function __construct() {
        $this-> loadModel("User");
        $this->userModel = new User();
    }

    function index (){

        $users = $this->userModel->getAll();

        $this->view('User/index.php', [
            'users'=>$users,
        ]);
    }

}