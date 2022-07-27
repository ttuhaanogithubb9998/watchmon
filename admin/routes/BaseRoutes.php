<?php
 abstract class BaseRoutes
{
    const CONTROLLER_ROOT=ROOT.'/admin/controllers/';
    
    abstract protected function run($path='');
    function loadCtrl($Name){

        $path = self::CONTROLLER_ROOT.$Name.'Controller.php';
        require_once($path);
    }
}

