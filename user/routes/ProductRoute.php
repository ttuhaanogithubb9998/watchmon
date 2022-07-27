<?php
class ProductRoute extends BaseRoutes
{
    private $productCtrl;
    private $path;
    function __construct()
    {
        $this->loadCtrl('Product');
        $this->productCtrl = new ProductController();
    }



    function run($path = '')
    {
        $METHOD = $_SERVER["REQUEST_METHOD"];
        $this->path = $path;

        if ($METHOD === 'POST') {
            $this->post();
        } else {
            $this->get();
        }
    }
    function get()
    {
        $this->productCtrl->showAll();

    }
    function post()
    {
        switch ($this->path) {
            case '/remove':

                $productId = $_POST['id'];
                $HTTP_REFERER = $_SERVER['HTTP_REFERER'];
                $res =   $this->productCtrl->removeStock($productId);
                
                header("Location: {$HTTP_REFERER}", true, 301);
                exit;
        }

        $this->productCtrl->showDetail();
    }
}
