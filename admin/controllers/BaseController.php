<?php
class BaseController
{
    const MODEL_ROOT = ROOT.'/admin/models/';
    const LAYOUT = ROOT.'/admin/views/layout.php';

    
    /**
     * Load view 
     * @param $viewPath vd: Product/index.php (thuộc views)
     * @param $arrayData đẩy dữ liệu tới view ["tên biến1"=>giá trị,..]
     *  vd: ["product"=>$Product,"title"=>$title,...]
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
