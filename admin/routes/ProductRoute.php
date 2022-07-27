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
        switch($this->path){
            case '/create':
                    $this->productCtrl->getFromCreate();
                break;
            default:
                $this->productCtrl->showAll();
        }
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
                break;
            case '/create':

                // khai báo biến product
                $name = isset($_POST['name'])?$_POST['name']:false;
                $description = isset($_POST['description'])?$_POST['description']:false;
                $price = isset($_POST['price'])?$_POST['price']:false;
                $priceSale = isset($_POST['priceSale'])?$_POST['priceSale']:false;
                $stock = isset($_POST['stock'])?$_POST['stock']:false;
                $state = isset($_POST['state'])?1:0;
                $files = $_FILES['files'];
                
                $isImage = true;

                foreach ($files["tmp_name"] as $tmp){
                    if(getimagesize($tmp)===false){
                        $isImage = false;
                        break;
                    }
                }

                if($name||$description||$price||$priceSale||$stock){
                    $error = "một hoặc nhiều trường dữ liệu bị bỏ trống!"; 
                    $this->productCtrl->getFromCreate($error);
                }
                
                if(!$isImage){
                    $error = "Định dạng ảnh không hợp lệ";
                    $this->productCtrl->getFromCreate($error);
                    
                }{
                    $this->productCtrl->create($name, $description, $price, $priceSale, $stock, $state, $files);
                    
                }
                
                break;
        }

    }
}
