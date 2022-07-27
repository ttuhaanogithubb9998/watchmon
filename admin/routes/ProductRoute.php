<?php
class ProductRoute extends BaseRoutes
{
    private $productCtrl;
    private $path;
    function __construct()
    {
        parent::__construct();
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

        switch ($this->path) {

            case '':
            case '/':
                return $this->productCtrl->index();
            case '/create':
            case '/create/':
                return $this->productCtrl->getFromCreate();
            default:
                $this->baseCtrl->notFound();
        }
    }

    function post()
    {
        switch ($this->path) {
            case '/create':

                // khai báo biến product
                $name = isset($_POST['name']) ? $_POST['name'] : false;
                $description = isset($_POST['description']) ? $_POST['description'] : false;
                $price = isset($_POST['price']) ? $_POST['price'] : false;
                $priceSale = isset($_POST['priceSale']) ? $_POST['priceSale'] : false;
                $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
                $state = isset($_POST['state']) ? 1 : 0;
                $files = isset($_FILES['files']) ? $_FILES['files'] : false;

                if (!$name || !$description || !$price || !$priceSale || !$stock || !$files) {
                    $message = "một hoặc nhiều trường dữ liệu bị bỏ trống!";
                    return $this->productCtrl->getFromCreate($message, 'danger');
                }

                $isImage = true;

                foreach (isset($files["tmp_name"]) ? $files["tmp_name"] : [] as $tmp) {
                    if (getimagesize($tmp) === false) {
                        $isImage = false;
                        break;
                    }
                }


                if (!$isImage) {
                    $message = "Định dạng ảnh không hợp lệ";
                    return $this->productCtrl->getFromCreate($message, 'danger');
                } {
                    return $this->productCtrl->create($name, $description, $price, $priceSale, $stock, $state, $files);
                }

                break;
        }
    }
}
