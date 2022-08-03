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

    function index()
    {

        $subImageModel = new SubImage();
        $productCategoryModel = new ProductCategory();
        $categoryModel = new Category();

        // get product
        $products = $this->productModel->getAll();

        for ($i = 0; $i < count($products); $i++) {
            // get list image
            $arrImg = $subImageModel->getImages($products[$i]['id']);

            //get list category 
            $productCategories = $productCategoryModel->getListByProduct($products[$i]['id']);
            $categories = [];
            foreach ($productCategories as $productCategory) {
                $category = $categoryModel->getCategory($productCategory['categoryId']);

                if ($category) {
                    $categories[] = $category;
                }
            }

            // push in Product
            $products[$i] = array_merge($products[$i], ['images' => $arrImg], ['categories' => $categories]);
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
            $products = $this->productModel->getProduct($category["productId"]);
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


    /**
     * 
     */
    function getFromCreate($message = '', $type = "primary")
    {

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $this->view('Product/create.php', [
            "message" => $message,
            "type" => $type,
            "categories" => $categories
        ]);
    }

    /**
     * 
     */
    function getFromEdit($productId, $message = '', $type = "primary")
    {
        $categoryModel = new Category();
        $productCategoryModel = new ProductCategory();

        $categories = $categoryModel->getAll();

        $product = $this->productModel->getProduct($productId);
        $productCategories = $productCategoryModel->getListByProduct($productId);
        $categoriesId = [];
        foreach ($productCategories as $productCategory) {
            $categoriesId[] = $productCategory['categoryId'];
        }
        $product = array_merge($product, ["categoriesId" => $categoriesId]);

        return $this->view('Product/edit.php', [
            "message" => $message,
            "type" => $type,
            "categories" => $categories,
            "product" =>  $product
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
    function create($name, $description, $price, $priceSale, $stock, $state, $files, $categoriesId)
    {
        foreach ($files['size'] as $size) {
            if ($mb = number_format($size / 1048576, 2) > 1) {
                return $this->getFromCreate("Kích thước file không vượt quá 1mb/1file ", "danger");
            }
        }

        if (
            strlen($name) == 0
            || strlen($description) == 0
            || strlen($priceSale) == 0
            || strlen($stock) == 0
            || $files['name'][0] == ""
            || count($categoriesId) == 0
        ) {
            $message = "một hoặc nhiều trường dữ liệu bị bỏ trống!";
            return $this->getFromCreate($message, 'danger');
        }

        foreach (isset($files["tmp_name"]) ? $files["tmp_name"] : [] as $tmp) {
            if (getimagesize($tmp) === false) {
                $message = "Định dạng ảnh không hợp lệ";
                return $this->getFromCreate($message, 'danger');
            }
        }


        $product = $this->productModel->create($name, $description, $price, $priceSale, $stock, $state);


        if ($product !== false) {
            $productId = $product['id'];
            $pathUpload = ROOT . '/upload/image/product/';
            $subImageModel = new SubImage();
            $productCategoryModel = new ProductCategory();


            foreach ($categoriesId as $categoryId) {
                $productCategoryModel->create($productId, $categoryId);
            }


            $length = count($files['name']);
            for ($i = 0; $i < $length; $i++) {

                $extensionImg = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
                $randomNameImg  = md5((new DateTime())->format('Y-m-d H:i:s.u'));
                $fileName = $randomNameImg . '.' . $extensionImg;
                $targetPath = $pathUpload . $fileName;
                $loaded = move_uploaded_file($files['tmp_name'][$i], $targetPath);

                if ($loaded) {
                    $subImageModel->addImage($productId, $fileName);
                }
            }

            return $this->getFromCreate("Thành công!");
        }
        return $this->getFromCreate("Thành công!");
    }

    function edit($productId, $name, $description, $price, $priceSale, $stock, $state, $files, $categoriesId)
    {
        foreach ($files['size'] as $size) {
            if ($mb = number_format($size / 1048576, 2) > 1) {
                return $this->getFromEdit($productId, "Kích thước file không vượt quá 1mb/1file ", "danger");
            }
        }

        if (
            strlen($name) == 0
            || strlen($description) == 0
            || strlen($priceSale) == 0
            || strlen($stock) == 0
            || $files['name'][0] == ""
            || count($categoriesId) == 0
        ) {
            $message = "một hoặc nhiều trường dữ liệu bị bỏ trống!";
            return $this->getFromEdit($productId, $message, 'danger');
        }

        foreach (isset($files["tmp_name"]) ? $files["tmp_name"] : [] as $tmp) {
            if (getimagesize($tmp) === false) {
                $message = "Định dạng ảnh không hợp lệ";
                return $this->getFromEdit($productId, $message, 'danger');
            }
        }




        $pathUpload = ROOT . '/upload/image/product/';
        $productCategoryModel = new ProductCategory();
        $subImageModel = new Subimage();

        // edit dữ liệu của product
        $this->productModel->edit($productId, $name, $description, $price, $priceSale, $stock, $state);
        
        // xoá toàn bộ liên kết của product với category và tạo những liên kết mới
        $productCategoryModel->deleteByProductId($productId);
        foreach ($categoriesId as $categoryId) {
            $productCategoryModel->create($productId, $categoryId);
        }

        // xoá những ảnh của product
        $images =  $subImageModel->getImages($productId);
        foreach ($images as $image) {
            $s =  unlink($pathUpload.$image['filename']);
        } 
        $subImageModel->deleteByProductId($productId);

        // update ảnh mới
        $length = count($files['name']);
        for ($i = 0; $i < $length; $i++) {

            $extensionImg = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
            $randomNameImg  = md5((new DateTime())->format('Y-m-d H:i:s.u'));
            $fileName = $randomNameImg . '.' . $extensionImg;
            $targetPath = $pathUpload . $fileName;
            $loaded = move_uploaded_file($files['tmp_name'][$i], $targetPath);

            if ($loaded) {
                $subImageModel->addImage($productId, $fileName);
            }
        }

        return $this->getFromEdit($productId, "Thành công!");
    }
}
