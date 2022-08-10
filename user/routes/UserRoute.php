<?php
class UserRoute extends BaseRoutes
{
    private $userCtrl;
    function __construct()
    {
        $this->loadCtrl('User');
        $this->userCtrl = new UserController();
    }



    function get()
    {

        switch (true) {
            case preg_match('/^[\/]{0,1}$/', $this->path) != 0:
                return $this->userCtrl->index();
            case preg_match('/^(\/login)[\/]{0,1}$/', $this->path) != 0:
                return $this->userCtrl->getFormLogin();
            case preg_match('/^(\/register)[\/]{0,1}$/', $this->path) != 0:
                return $this->userCtrl->getFormRegister();
            case preg_match('/^(\/logout)[\/]{0,1}$/', $this->path) != 0:
                return $this->userCtrl->logout();
            case preg_match('/^(\/invoice)[\/]{0,1}$/', $this->path) != 0:
                return $this->userCtrl->invoice();
            case preg_match('/^(\/invoiceDetail\?id=)[0-9]{0,10}$/', $this->path) != 0:
                $invoiceId = $_GET['id'];
                return $this->userCtrl->invoiceDetail($invoiceId);
            default:
                $this->userCtrl->notFound();
        }
    }
    function post()
    {
        switch (true) {
            case preg_match('/^(\/login)[\/]{0,1}$/', $this->path) != 0:

                $userName = isset($_POST['userName']) ? trim($_POST['userName']) : "";
                $password = isset($_POST['password']) ? trim($_POST['password']) : "";
                return $this->userCtrl->login($userName, $password);

            case preg_match('/^(\/register)[\/]{0,1}$/', $this->path) != 0:
                $userName = isset($_POST['userName']) ? trim($_POST['userName']) : "";
                $password = isset($_POST['password']) ? trim($_POST['password']) : "";
                $name = isset($_POST['name']) ? trim($_POST['name']) : "";
                $address = isset($_POST['address']) ? trim($_POST['address']) : "";
                $email = isset($_POST['email']) ? trim($_POST['email']) : "";
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";

                return $this->userCtrl->register($userName, $password, $name, $address, $email, $phone);
            case preg_match('/^(\/edit)[\/]{0,1}$/', $this->path) != 0:

                $password = isset($_POST['password']) ? trim($_POST['password']) : "";
                $newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : "";
                $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : "";
                $name = isset($_POST['name']) ? trim($_POST['name']) : "";
                $address = isset($_POST['address']) ? trim($_POST['address']) : "";
                $email = isset($_POST['email']) ? trim($_POST['email']) : "";
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";

                return $this->userCtrl->edit( $password,$newPassword,$confirmPassword, $name, $address, $email, $phone);
            default:
                $this->userCtrl->notFound();
        }
    }
}
