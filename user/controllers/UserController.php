<?php
class UserController extends BaseController
{
    private $userModel;
    function __construct()
    {
        parent::__construct();
        $this->loadModel("User");
        $this->loadModel("Invoice");
        $this->loadModel("Product");
        $this->loadModel("InvoiceDetail");
        $this->userModel = new User();
    }

    function checkLogged()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $baseUrl = BASE_URL;
            header("Location: $baseUrl" . "user");
            exit();
        }
    }



    /**
     * GET
     */
    function index($message = "")
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            $baseUrl = BASE_URL;
            header("Location: $baseUrl" . "user/login");
            exit();
        }



        $users = $_SESSION['user'];

        return $this->view('User/index.php', [
            'users' => $users,
            'message' => $message
        ]);
    }

    function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        $baseUrl = BASE_URL;
        header("Location: $baseUrl");
    }
    function getFormLogin($userName = '', $password = '', $message = '')
    {
        $this->checkLogged();
        return  $this->view('User/login.php', [

            'userName' => $userName,
            'password' => $password,
            'message' => $message
        ]);
    }


    function getFormRegister($userName = "", $password = "", $name = "", $address = "", $email = "", $phone = "", $message = "")
    {
        $this->checkLogged();


        return $this->view("User/register.php", [
            "userName" => $userName,
            "password" => $password,
            "name" => $name,
            "address" => $address,
            "email" => $email,
            "phone" => $phone,
            "message" => $message
        ]);
    }

    function invoice()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            $baseUrl = BASE_URL;
            header("Location: $baseUrl" . "user/login");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $invoiceModel = new Invoice();
        $invoices = $invoiceModel->getInvoicesByUser($userId);



        return $this->view('User/invoice.php', [
            'invoices' => $invoices
        ]);
    }

    function invoiceDetail($invoiceId){
        $invoiceDetailModel = new InvoiceDetail();
        $productModel = new Product();
        $subImageModel = new Subimage();
        $invoiceModel = new Invoice();



        $invoice = $invoiceModel->getInvoice($invoiceId)[0];
        $total = $invoice['total'];
        $invoiceDetails = $invoiceDetailModel->getListByInvoice($invoiceId);

        for($i=0;$i<count($invoiceDetails);$i++){
            $product = $productModel->getProduct($invoiceDetails[$i]['productId']);
            $images = $subImageModel->getImages($product['id']);
            $product['images'] = $images;
            
            $invoiceDetails[$i]['product']= $product;
        }

        return $this->view('User/invoiceDetail.php',[
            'invoiceDetails'=> $invoiceDetails,
            'total'=> $total
        ]);
    }


    /**
     * POST
     */
    function login($userName, $password)
    {


        if ($userName == "" || $password == "") {
            $message = "Vui lòng điền đầy đủ!";
            return $this->getFormLogin($userName, $password, $message);
        }

        $user = $this->userModel->getLogin($userName, $password);



        if (isset($user['id'])) {

            // lưu session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION["user"] = $user;


            $baseUrl = BASE_URL;
            header("Location: $baseUrl");
            exit();
        } else {
            $message = "Đăng nhập thất bại!";
            return $this->getFormLogin($userName, $password, $message);
        }
    }
    function register($userName, $password, $name, $address, $email, $phone)
    {

        if ($userName == "" || $password == "" || $name == "" || $address == "" || $email == "") {
            $message = "Vui lòng điền đầy đủ!";
            return $this->getFormRegister($userName, $password, $name, $address, $email, $phone, $message);
        }

        $register = $this->userModel->register($userName, $password, $name, $address, $email, $phone);

        if ($register['status'] == false) {
            $message = $register['message'];
            return $this->getFormRegister($userName, $password, $name, $address, $email, $phone, $message);
        } else {
            // lưu session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["user"] = $register["user"];

            $baseUrl = BASE_URL;
            header("Location: $baseUrl");
            exit();
        }
    }

    function edit($password, $newPassword, $confirmPassword, $name, $address, $email, $phone)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($name == '' || $address == '' || $phone == '' || $email == '' || $newPassword == '' || $password == '' || $confirmPassword == '') {
            $message = "Các trường dữ liệu không đươc bỏ trống!";
            return $this->index($message);
        }


        if (md5($password) != $_SESSION['user']['password']) {
            $message = "mật khẩu không chính xác!";
            return $this->index($message);
        }
        if ($newPassword != $confirmPassword) {
            $message = "xác thực mật khẩu mới không khớp!";
            return $this->index($message);
        }
        $edit = $this->userModel->edit($_SESSION['user']['id'], $newPassword, $name, $address, $email, $phone);

        $this->dataLayout();
        return $this->index($edit['message']);
    }
}
