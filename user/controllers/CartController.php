<?php
class CartController extends BaseController
{
    private $cartModel;
    function __construct()
    {
        $this->loadModel('Cart');
        $this->loadModel('Product');
        $this->cartModel = new Cart();
    }
    function checkLogged()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            $baseUrl = BASE_URL;
            header("Location: $baseUrl" . "user/login");
            exit();
        }
    }


    /**
     * GET function
     */

    /***/

    function index()
    {
        $this->checkLogged();

        return $this->view('Cart/index.php', []);
    }

    function getFormOder()
    {

        return $this->view('Cart/oder.php', []);
    }

    /**
     * POST function
     */

    /***/
    function addToCart($productId)
    {
        $productModel = new Product();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["user"]['id'])) {
            $response['logged'] = true;
            $userId = $_SESSION["user"]['id'];

            $cart = $this->cartModel->getCartsByUserAndProduct($userId, $productId);

            if (count($cart) > 0) {
                $row = $this->cartModel->update(['quantity' => $cart[0]['quantity'] + 1], $cart[0]['id']);

                if ($row > 0) {
                    $carts = $this->cartModel->getCartsByUser($userId);
                    $total = 0;
                    foreach ($carts as $c) {
                        $p = $productModel->getProduct($c["productId"]);
                        $total += $c["quantity"] * $p['price'];
                    }
                    $carts['total'] = $total;


                    $response["carts"] = $carts;
                }
            } else {
                $row = $this->cartModel->add($userId, $productId, 1);
                if ($row > 0) {
                    $carts = $this->cartModel->getCartsByUser($userId);
                    $total = 0;
                    foreach ($carts as $c) {
                        $p = $productModel->getProduct($c["productId"]);
                        $total += $c["quantity"] * $p['price'];
                    }
                    $carts['total'] = $total;


                    $response["carts"] = $carts;
                }
            }
            $message = "successfully";
            $response['message'] = $message;
        } else {
            $response['logged'] = false;
            $message = "fail";
            $response['message'] = $message;
        }
        die(json_encode($response));
    }


    function add($cartId)
    {
        if ($cartId > 0) {
            $productModel = new Product();
            $response = [];
            $cart = $this->cartModel->getCart($cartId);
            $product = $productModel->getProduct($cart['productId']);

            if ($product['stock'] > $cart['quantity']) {
                $this->cartModel->changeQuantity($cart['quantity'] + 1, $cartId);
                $response['message'] = "successfully";
                $response['code'] = "200";
                $response['quantity'] = $cart['quantity'] + 1;
                $response['stock'] = $product['stock'];
                $response['price'] = $product['price'];
            } else {
                $response['message'] = "số lượng trong kho không đủ";
                $response['code'] = "500";
                $response['quantity'] = $cart['quantity'] + 1;
                $response['stock'] = $product['stock'];
                $response['price'] = $product['price'];
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $userId = $_SESSION['user']['id'];
            $carts = $this->cartModel->getCartsByUser($userId);
            $total = 0;
            foreach ($carts as $c) {
                $price = $productModel->getProduct($c['productId'])['price'];
                $total += $c['quantity'] * $price;
            }
            $response['total'] = $total;


            die(json_encode($response));
        }
    }

    function remove($cartId)
    {
        $productModel = new Product();
        $response = [];

        $cart = $this->cartModel->getCart($cartId);
        $product = $productModel->getProduct($cart['productId']);

        if ($cart['quantity'] <= 1) {

            $this->cartModel->delete(['id' => [$cartId, '=']]);
            $response['message'] = "successfully";
            $response['code'] = "200";
            $response['quantity'] = 0;
            $response['stock'] = $product['stock'];
            $response['price'] = $product['price'];
        } else {

            $this->cartModel->changeQuantity($cart['quantity'] - 1, $cartId);
            $response['message'] = "successfully";
            $response['code'] = "200";
            $response['quantity'] = $cart['quantity'] - 1;
            $response['stock'] = $product['stock'];
            $response['price'] = $product['price'];
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user']['id'];

        $carts = $this->cartModel->getCartsByUser($userId);
        $total = 0;
        foreach ($carts as $c) {
            $price = $productModel->getProduct($c['productId'])['price'];
            $total += $c['quantity'] * $price;
        }
        $response['total'] = $total;


        die(json_encode($response));
    }

    function removeAll($cartId)
    {
        $productModel = new Product();
        $response = [];

        $cart = $this->cartModel->getCart($cartId);
        $product = $productModel->getProduct($cart['productId']);


        $this->cartModel->delete(['id' => [$cartId, '=']]);
        $response['message'] = "successfully";
        $response['code'] = "200";
        $response['quantity'] = 0;
        $response['stock'] = $product['stock'];
        $response['price'] = $product['price'];


        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user']['id'];

        $carts = $this->cartModel->getCartsByUser($userId);
        $total = 0;
        foreach ($carts as $c) {
            $price = $productModel->getProduct($c['productId'])['price'];
            $total += $c['quantity'] * $price;
        }
        $response['total'] = $total;


        die(json_encode($response));
    }


    function addMulti($productId, $quantity)
    {

        $this->checkLogged();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"]['id'])) {
            $userId = $_SESSION["user"]['id'];
            $cart = $this->cartModel->getCartsByUserAndProduct($userId, $productId);

            if (count($cart) > 0) {
                $this->cartModel->update(['quantity' => $cart[0]['quantity'] + $quantity], $cart[0]['id']);
            } else {
                $this->cartModel->add($userId, $productId, $quantity);
            }
        }

        $baseUrl = BASE_URL;
        header("Location: $baseUrl" . "cart");
        exit();
    }
}
