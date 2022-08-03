<?php
class BaseController
{
    const MODEL_ROOT = ROOT . '/user/models/';
    const LAYOUT = ROOT . '/user/views/layout.php';


    /**
     * Load view 
     */
    function view($viewPath, $arrayData)
    {
        // tạo biến để truy xuất từ view
        foreach ($arrayData as $key => $value) {
            $$key = $value;
        }
        $dataLayout = $this->dataLayout();
        foreach ($dataLayout as $key => $value) {
            $$key = $value;
        }

        $viewAction = $viewPath;
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
        $dataLayout = $this->dataLayout();
        foreach ($dataLayout as $key => $value) {
            $$key = $value;
        }

        $viewAction = 'notFound.html';
        require_once(self::LAYOUT);
    }

    /**
     * lấy dữ liệ lay out 
     * lấy dữ liệu user nếu đã đăng nhập 
     */
    function dataLayout()
    {
        $data = [];

        $this->loadModel("Category");
        $categoryModel = new Category();
        $this->loadModel("Cart");
        $cartModel = new Cart();
        $this->loadModel("Product");
        $productModel = new Product();
        $this->loadModel("Subimage");
        $subImageModel = new Subimage();

        $categories = $categoryModel->getAll();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : "";

        if (isset($user['id'])) {
            $carts = $cartModel->getCartsByUser($user['id']);
            
            $total = 0;
            for($i=0;$i<count($carts);$i++)  {
                $product = $productModel->getProduct($carts[$i]['productId']);
                $subimage = $subImageModel->getImages($product['id']);
                $product['images'] = $subimage;
                $carts[$i]['product']=$product;
                $total +=  $carts[$i]['quantity'] * $product['price'];
            }
            $carts = array_merge($carts, ["total" => $total]);
            $user = array_merge($user, ["carts" => $carts]);
        }


        $data = array_merge(
            ['user' => $user],
            ['categories' => $categories]
        );

        return $data;
    }
}
