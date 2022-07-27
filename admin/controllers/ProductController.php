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
            $subImage = new SubImage();
            $pathUpload = ROOT . '/upload/image/product';

            var_dump($files);
        }
    }
}
