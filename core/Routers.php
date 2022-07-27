<?php
class Routers
{

    private $baseCtrl;
    private $REQUEST_URI;
    private $arrUse = [];

    function __construct($baseCtrl)
    {
        $this->REQUEST_URI =str_replace('/admin','',$_SERVER['REQUEST_URI']);
        $this->baseCtrl = $baseCtrl;
    }



    function use($path, $route)
    {
        $this->arrUse = array_merge($this->arrUse, [$path => $route]);
    }

    function run()
    {
        $isNotFound = true;

        foreach ($this->arrUse as $path => $route) {

            if ($this->REQUEST_URI == $path || $this->REQUEST_URI == $path . '/') {

                $route->run();
                $isNotFound = false;
                break;
            }

            $index = strpos($this->REQUEST_URI, $path);

            if ($index === 0) {
                $pathChild = str_replace($path, '', $this->REQUEST_URI);
                $isPath = strpos($pathChild, '/') === 0;

                if ($isPath) {
                    $route->run($pathChild);
                    $isNotFound = false;
                    break;
                }

            }
        }
       


        if ($isNotFound) $this->baseCtrl->notFound();
    }

    function __destruct()
    {
        $this->run();
    }
}
