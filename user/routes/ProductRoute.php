<?php
class ProductRoute extends BaseRoutes
{
    private $productCtrl;
    function __construct()
    {
        $this->loadCtrl('Product');
        $this->productCtrl = new ProductController();
    }




    function get()
    {
        switch (true) {
            case preg_match('/^(\/){0,1}$/', $this->path) != 0:
                return $this->productCtrl->index();
            case preg_match('/^(\/page\?id=)[0-9]{1,10}$/', $this->path) != 0:
                $indexPage = isset($_GET['id']) ? $_GET['id'] :1;
                return $this->productCtrl->index($indexPage);
            case preg_match('/^(\/category\?id=)[0-9]{1,10}$/', $this->path) != 0:
                $categoryId = isset($_GET['id']) ? $_GET['id'] :1;
                return $this->productCtrl->showByCategory($categoryId);
            case preg_match('/^(\/detail\?id=)[0-9]{1,10}$/', $this->path) != 0:
                $productId = isset($_GET['id']) ? $_GET['id'] :1;
                return $this->productCtrl->detail($productId);
            default:
                $this->productCtrl->notFound();
        }
    }

    function post()
    {
        switch ($this->path) {
            default:
                $this->productCtrl->notFound();
        }
    }
}
