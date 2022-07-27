<?php
class ProductController extends BaseController
{
    private $productModel;
    function __construct()
    {
        $this->loadModel('Product');
        $this->loadModel("ProductCategory");
        $this->loadModel("SubImage");
        $this->productModel = new Product();
    }


    /**
     * GET function
     */

    /***/

    function show($categoryId)
    {
        $productCategoryModel = new ProductCategory();

        $products = [];
        foreach ($productCategoryModel->getListByCategory($categoryId) as $category) {
            $products = $this->productModel->getId($category["productId"]);
        }

        $this->view('Product/index.php', [
            'products' => $products
        ]);
    }

    function showDetail()
    {
    }
    function showAll()
    {
        $products = [];

        $products =  $this->productModel->getAll();

        $this->view('Product/index.php', [
            'products' => $products
        ]);
    }

    function getFromCreate($error = '')
    {

        $this->view('Product/create.php', [
            "error" => $error
        ]);
    }

    /**
     * POST function
     */

    /**
     * 
     */
    function removeStock($productId)
    {

        $this->productModel->removeStock($productId, 1);

        return '"[{"productId":"asdf"}]"';
    }

    /**
     * 
     */
    function create($name, $description, $price, $priceSale, $stock, $state, $files)
    {

        foreach ($files['size'] as $size) {
            if ($mb = number_format($size / 1048576, 2) > 1) {
                return $this->view('Product/create.php', [
                    'error' => "Kích thước file không vượt quá 1mb ($mb)MB"
                ]);
            }
        }

        $product = $this->productModel->create($name, $description, $price, $priceSale, $stock, $state);


        if ($product !== false) {
            $productId = $product['id'];
            $subImageModel = new SubImage();
            $pathUpload = ROOT . '/upload/image/product/';
            $length = count($files['name']) ; 
            for($i = 0; $i < $length; $i++) {

                $extensionImg = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
                $randomNameImg  = md5((new DateTime())->format('Y-m-d H:i:s.u'));
                $fileName = $randomNameImg .'.'. $extensionImg;
                $targetPath = $pathUpload.$fileName;
                $loaded = move_uploaded_file($files['tmp_name'][$i], $targetPath);
                
                var_dump($loaded);
                if($loaded){
                    $subImageModel->addImage($productId,$fileName);
                }

            }
        }
        die();
    }
}
