<?php
abstract class BaseRoutes
{
    const CONTROLLER_ROOT = ROOT . '/user/controllers/';
    protected $path;
    abstract protected function post();
    abstract protected function get();


    function run($path)
    {

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

        $path = self::CONTROLLER_ROOT . $Name . 'Controller.php';
        require_once($path);
    }
}
