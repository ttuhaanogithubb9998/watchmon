<?php
class ProductController extends BaseController
{
    private $productModel;
    function __construct()
    {
        $this->loadModel("Product");
        $this->loadModel("Category");
        $this->loadModel("ProductCategory");
        $this->loadModel("Subimage");

        $this->productModel = new Product();
    }

    function isSale($productId)
    {
        $productCategoryModel = new ProductCategory();
        $categoryModel = new Category();

        $list = $productCategoryModel->getListByProduct($productId);

        foreach ($list as $pC) {
            $category =  $categoryModel->getCategory($pC["categoryId"]);
            if ($category) {
                if (strpos(strtolower($category['name']), 'sale') !== false) {
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * GET function
     */

    /***/
    function index($indexPage = 1)
    {
        $numberOf = 9;
        $subImageModel = new Subimage();



        $products = [];

        if ($indexPage > 0) {

            $limitStart = ($indexPage - 1) * $numberOf;
            $products = $this->productModel->getListLimit($limitStart, $numberOf);
            for ($i = 0; $i < count($products); $i++) {
                $isSale = $this->isSale($products[$i]['id']);
                $images = $subImageModel->getImages($products[$i]['id']);

                $products[$i] = array_merge($products[$i], ['images' => $images], ['sale' => $isSale]);
            }
        }

        $numberMaxPage = $this->productModel->getCountAll() / $numberOf + 1;
        $numberMaxPage = (int)$numberMaxPage;

        $this->view('Product/index.php', [
            'products' => $products,
            'indexPage' => $indexPage,
            'numberMaxPage' => $numberMaxPage,

        ]);
    }

    function showByCategory($categoryId)
    {

        $productCategoryModel = new ProductCategory();
        $subImageModel = new Subimage();
        $products = [];

        $productCategories = $productCategoryModel->getListByCategory($categoryId);

        foreach ($productCategories as $productCategory) {
            $product = $this->productModel->getProduct($productCategory['productId']);
            $isSale = $this->isSale($product['id']);
            $images = $subImageModel->getImages($product['id']);

            $product = array_merge($product, ['images' => $images], ['sale' => $isSale]);
            $products[] = $product;
        }


        $this->view('Product/category.php', [
            'products' => $products,

        ]);
    }

    function detail($productId)
    {
        $subImageModel = new Subimage();
        $productCategoryModel = new ProductCategory();
        $categoryModel = new Category();


        $product = $this->productModel->getProduct($productId);
        $images = $subImageModel->getImages($product['id']);

        $productCategories = $productCategoryModel->getListByProduct($productId);
        $categories=[];
        foreach ($productCategories as $productCategory){
            $category = $categoryModel->getCategory($productCategory['categoryId']);
            $categories[] = $category;
        }
        
        $product = array_merge($product, ['images' => $images],['categories'=>$categories]);

        $this->view('Product/detail.php', [
            "product" => $product,
        ]);
    }
}
