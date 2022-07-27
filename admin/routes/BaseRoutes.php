<?php
 abstract class BaseRoutes
{
    const CONTROLLER_ROOT=ROOT.'/admin/controllers/';
    protected $baseCtrl;
    function __construct(){
        $this-> loadCtrl("Base");
        $this->baseCtrl = new BaseController();
    }
    abstract protected function run($path='');
    function loadCtrl($Name){

        $path = self::CONTROLLER_ROOT.$Name.'Controller.php';
        require_once($path);
    }
}

