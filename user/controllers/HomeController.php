<?php
class HomeController extends BaseController
{
    const nameCategory = "sản phẩm hot";

    function __construct()
    {
        parent::__construct();
        $this->loadModel("Product");
        $this->loadModel("Category");
        $this->loadModel("ProductCategory");
        $this->loadModel("Subimage");
    }

    function index()
    {
        function isSale($productId){
            $productCategoryModel = new ProductCategory();
            $categoryModel = new Category();

            $list = $productCategoryModel->getListByProduct($productId);
            foreach($list as $pC){
               $category =  $categoryModel->getCategory($pC["categoryId"]);
                if($category){
                    if(strpos(strtolower($category['name']),'sale')!==false){
                        return true;
                    }
                }
            }
            return false;
        }

        $productModel = new Product();
        $categoryModel = new Category();
        $productCategoryModel = new ProductCategory();
        $subImageModel = new Subimage();

        // get hot product 

        $categories = $categoryModel->getCategoryByName(self::nameCategory);
        $hotProducts = [];
        if ($categories) {
            $categoryId = $categories[0]['id'];
            $productCategories = $productCategoryModel->getListByCategory($categoryId);
            // var_dump($productCategories);

            $i = 0;
            foreach ($productCategories as $productCategory) {
                $i++;
                $product = $productModel->getProduct($productCategory['productId']);

                $isSale = isSale($product['id']);
                $image = $subImageModel->getImages($product['id'])[0];

                $product =array_merge($product,['image'=>$image],['sale'=>$isSale]);
                $hotProducts[] = $product;
                if($i===6) break;
            }
        }


        return $this->view('Home/index.php', [
            'hotProducts' => $hotProducts
        ]);
    }
}
