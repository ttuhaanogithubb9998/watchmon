<?php
class LoginRoute extends BaseRoutes
{
    private $userCtrl;
    function __construct()
    {
        parent::__construct();
        $this->loadCtrl('User');
        $this->userCtrl = new UserController();
    }


    function post()
    {

        $userName = isset($_POST['userName']) ? trim($_POST['userName']) : "";
        $password = isset($_POST['password']) ? trim($_POST['password']) : "";
        return $this->userCtrl->login($userName, $password);
    }

    function get()
    {
        return $this->userCtrl->getFormLogin();
    }

    // override 
    // đã login
    function checkLogged()
    {
        session_start();

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['isAdmin'] == 1) {
                $baseUrl = BASE_URL;
                header("Location: $baseUrl" . "admin");
                exit();
            }
        }
    }
}
