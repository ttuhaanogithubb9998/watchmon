<?php
class ProductRoute extends BaseRoutes
{
    private $productCtrl;
    function __construct()
    {
        parent::__construct();
        $this->loadCtrl('Product');
        $this->productCtrl = new ProductController();
    }


    
    function get()
    {

        switch (true) {

            case $this->path == "":
                return $this->productCtrl->index();
            case preg_match('/^(\/create([\/]{0,1}|.html)$)/i', $this->path) != 0:
                return $this->productCtrl->getFromCreate();
            case preg_match('/^(\/edit)\?(id=)[0-9]{1,10}$/i', $this->path) != 0:

                $productId = isset($_GET['id']) ? $_GET['id'] :"";

                return $this->productCtrl->getFromEdit($productId);
            default:
                $this->baseCtrl->notFound();
        }
    }

    function post()
    {
        switch (true) {
            case preg_match('/^(\/create[\/]{0,1})$/i', $this->path):

                // khai báo biến product
                $name = isset($_POST['name']) ? trim($_POST['name']) : "";
                $description = isset($_POST['description']) ? trim($_POST['description']) : "";
                $price = isset($_POST['price']) ? trim($_POST['price']) : "";
                $priceSale = isset($_POST['priceSale']) ? trim($_POST['priceSale']) : "";
                $stock = isset($_POST['stock']) ? trim($_POST['stock']) : "";
                $state = isset($_POST['state']) ? 1 : 0;
                $files = isset($_FILES['files']) ? $_FILES['files'] : [];
                $categoriesId = isset($_POST['categoriesId']) ? $_POST['categoriesId'] : [];

                return $this->productCtrl->create($name, $description, $price, $priceSale, $stock, $state, $files, $categoriesId);

                break;
            case preg_match('/^(\/edit)$/i', $this->path) != 0:

                $productId = isset($_POST['id']) ? trim($_POST['id']) : "";
                $name = isset($_POST['name']) ? trim($_POST['name']) : "";
                $description = isset($_POST['description']) ? $_POST['description'] : "";
                $price = isset($_POST['price']) ? trim($_POST['price']) : "";
                $priceSale = isset($_POST['priceSale']) ? trim($_POST['priceSale']) : "";
                $stock = isset($_POST['stock']) ? trim($_POST['stock']) : "";
                $state = isset($_POST['state']) ? 1 : 0;
                $files = isset($_FILES['files']) ? $_FILES['files'] : [];
                $categoriesId = isset($_POST['categoriesId']) ? $_POST['categoriesId'] : [];

                return $this->productCtrl->edit($productId,$name, $description, $price, $priceSale, $stock, $state, $files, $categoriesId);
        }
    }
}
