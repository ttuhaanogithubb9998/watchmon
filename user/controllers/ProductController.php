<?php
class ProductController extends BaseController
{
    private $productModel;
    function __construct()
    {
        $this->loadModel('Product');
        $this->loadModel("ProductCategory");

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
            'products'=> $products
        ]);
    }

    function showDetail(){
        
    }
    function showAll(){
        $products = [];

        $products =  $this->productModel->getAll();

        $this->view('Product/index.php', [
            'products'=> $products
        ]);

    }


    /**
     * POST function
     */

    /**
     * 
     */
    function removeStock($productId){

        $this->productModel->removeStock($productId,1);

        return '"[{"productId":"asdf"}]"';

    }

}
