<?php
class CartController extends BaseController
{
    private $cartModel;
    function __construct()
    {
        parent::__construct();
        $this->loadModel('Cart');
        $this->loadModel('Product');
        $this->loadModel('Invoice');
        $this->loadModel('InvoiceDetail');
        $this->cartModel = new Cart();
    }
    function checkLogged()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']['id'])) {
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

    function getFormOder($message = "")
    {
        $this->checkLogged();

        return $this->view('Cart/oder.php', ['message' => $message]);
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
                $response['message'] = "s??? l?????ng trong kho kh??ng ?????";
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

    function pay($name, $address, $email, $phone, $description,$total)
    {
        if (isset($this->dataLayout['user']['id'])) {

            if ($name == '' || $address == '' || $email == '' || $phone == '' || $description == "") {
                $message = "Vui l??ng nh???p ?????y ????? th??ng tin!";
                return $this->getFormOder($message);
            }

            $user = $this->dataLayout['user'];
            $carts = $this->dataLayout['user']['carts'];

            foreach ($carts as $cart) {

                if (isset($cart['id']) && $cart['quantity'] > $cart['product']['stock']) {
                    $message = "M???t s??? s???n ph???m trong kho ???? h???t xin vui l??ng quay l???i gi??? h??ng ????? thay ?????i";
                    return $this->getFormOder($message);
                }
            }

            $invoiceModel = new Invoice();
            $invoiceDetailModel = new InvoiceDetail();
            $invoice = $invoiceModel->add($user['id'], $name, $address, $email, $phone, $description,$total);

            if (isset($invoice['id'])) {
                foreach ($carts as $cart) {
                    if (isset($cart['id'])) {
                        $invoiceDetail =  $invoiceDetailModel->add($invoice['id'], $cart['product']['id'], $cart['quantity']);
                        if (!$invoiceDetail) {
                            $invoiceModel->remove($invoice['id']);
                            $message = "l???i h??? th???ng!";
                            return $this->getFormOder($message);
                        }
                    }
                }
            } else {
                $message = "l???i h??? th???ng!";
                return $this->getFormOder($message);
            }
            foreach ($carts as $cart) {
                if (isset($cart['id'])) {
                    $this->cartModel->remove($cart['id']);
                }
            }
            $baseUrl = BASE_URL;
            return Header("Location: {$baseUrl}user/invoice");
        }
    }
}
