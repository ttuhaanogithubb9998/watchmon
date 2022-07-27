<?php
class ProductController extends BaseController
{
    private $productModel;
    function __construct()
    {
        $this->loadModel('Product');
        $this->loadModel("ProductCategory");
        $this->loadModel("SubImage");
        $this->loadModel("Category");
        $this->productModel = new Product();
    }


    /**
     * GET function
     */

    /***/

    function index(){
        
        $subImageModel = new SubImage();
        $productCategoryModel = new ProductCategory();
        $categoryModel = new Category();
        
        // get product
        $products = $this->productModel->getAll();
        
        for($i = 0; $i < count($products); $i++){
            // get list image
            $arrImg = $subImageModel->getImages($products[$i]['id']);

            //get list category 
            $productCategories = $productCategoryModel->getListByProduct($products[$i]['id']);
            $categories =[];
            foreach($productCategories as $productCategory){
                $category = $categoryModel->getCategory($productCategory['categoryId']);

                if($category){
                    $categories[] = $category;
                } 
            }   

            // push in Product
            $products[$i] = array_merge($products[$i],['images'=>$arrImg],['categories'=>$categories]);
            
        }
        return  $this->view('Product/index.php', [
            'products' => $products
        ]);
    }

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

    function getFromCreate($message = '',$type = "primary")
    {

        $this->view('Product/create.php', [
            "message" => $message,
            "type" => $type
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
                return $this->getFromCreate("Kích thước file không vượt quá 1mb ($mb)MB","danger");
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
            $this->getFromCreate("Thành công!");
        }
    }
}
