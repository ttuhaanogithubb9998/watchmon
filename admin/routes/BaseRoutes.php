<?php
abstract class BaseRoutes
{
    const CONTROLLER_ROOT = ROOT . '/admin/controllers/';
    protected $baseCtrl;
    protected $path;

    function __construct()
    {
        $this->loadCtrl("Base");
        $this->baseCtrl = new BaseController();
    }
    abstract protected function post();
    abstract protected function get();

    function run($path)
    {
        
        $this->checkLogged();


        $METHOD = $_SERVER["REQUEST_METHOD"];
        $this->path = $path;

        // check method
        if ($METHOD === 'POST') {
            return  $this->post();
        } else {
            return $this->get();
        }
    }


    function loadCtrl($Name)
    {

        $pathCtrl = self::CONTROLLER_ROOT . $Name . 'Controller.php';
        require_once($pathCtrl);
    }

    //chưa login
    function checkLogged()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            if($_SESSION['user']['isAdmin']==0){
                $baseUrl = BASE_URL;
                header("Location: $baseUrl"."admin/login");
                exit();
            }
        }
    }
}
