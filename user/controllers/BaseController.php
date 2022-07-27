<?php
class BaseController
{
    const MODEL_ROOT = ROOT.'/user/models/';
    const LAYOUT = ROOT.'/user/views/layout.php';

    
    /**
     * Load view 
     */
    function view($viewPath, $arrayData)
    {
        // tạo biến để truy xuất từ view
        foreach ($arrayData as $key => $value) {
            $$key = $value;
        }

        $viewAction =$viewPath;
        require_once(self::LAYOUT);
    }

    // load models;

    function loadModel($modelName)
    {

        $path = self::MODEL_ROOT . $modelName . '.php';
        require_once($path);
    }

    function notFound()
    {
        $viewAction = 'notFound.html';
        require_once(self::LAYOUT);
    }
}
