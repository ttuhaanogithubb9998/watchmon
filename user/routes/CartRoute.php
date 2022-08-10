<?php
class CartRoute extends BaseRoutes
{
    private $cartCtrl;
    function __construct()
    {
        $this->loadCtrl('Cart');
        $this->cartCtrl = new CartController();
    }





    function get()
    {
        switch (true) {
            case preg_match('/^(\/){0,1}$/', $this->path) != 0:
                return   $this->cartCtrl->index();

            case preg_match('/^(\/oder)[\/]{0,1}$/', $this->path) != 0:
                return $this->cartCtrl->getFormOder();
            default:
                $this->cartCtrl->notFound();
        }
    }

    function post()
    {

        switch (true) {
            case preg_match('/^(\/add_to_cart)$/', $this->path) != 0:
                $productId = isset($_POST['productId']) ? $_POST['productId'] : 0;
                return $this->cartCtrl->addToCart($productId);

            case preg_match('/^(\/add)$/', $this->path) != 0:
                $cartId = isset($_POST['cartId']) ? $_POST['cartId'] : 0;
                return $this->cartCtrl->add($cartId);

            case preg_match('/^(\/remove)$/', $this->path) != 0:
                $cartId = isset($_POST['cartId']) ? $_POST['cartId'] : 0;
                return $this->cartCtrl->remove($cartId);

            case preg_match('/^(\/remove_all)$/', $this->path) != 0:
                $cartId = isset($_POST['cartId']) ? $_POST['cartId'] : 0;
                return $this->cartCtrl->removeAll($cartId);

            case preg_match('/^(\/addMulti)$/', $this->path) != 0:
                $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
                $productId = isset($_POST['productId']) ? $_POST['productId'] : 0;
                return $this->cartCtrl->addMulti($productId, $quantity);
            case preg_match('/^(\/pay)$/', $this->path) != 0:
                $name = isset($_POST['name']) ? trim($_POST['name']) : "";
                $address = isset($_POST['address']) ? trim($_POST['address']) : "";
                $email = isset($_POST['email']) ? trim($_POST['email']) : "";
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
                $description = isset($_POST['description']) ? trim($_POST['description']) : "";
                $total = isset($_POST['total']) ? trim($_POST['total']) : "";

                return $this->cartCtrl->pay($name, $address, $email, $phone, $description,$total);
            default:
                $this->cartCtrl->notFound();
        }
    }
}
