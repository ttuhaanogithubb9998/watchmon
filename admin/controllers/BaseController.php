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
     * @param string path view layout
     */
    function view($viewPath, $arrayData,$viewLayout = self::LAYOUT)
    {
        // tạo biến để truy xuất từ view
        foreach ($arrayData as $key => $value) {
            $$key = $value;
        }

        $viewAction =$viewPath;
        require_once($viewLayout);
    }

    // load models;

    function loadModel($modelName)
    {

        $path = self::MODEL_ROOT . $modelName . '.php';
        require_once($path);
    }

    function notFound()
    {
        require_once(ROOT . '/admin/views/notFound.php');
    }

    


}
