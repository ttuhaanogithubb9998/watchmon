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
            $message = "Vui l??ng ??i???n ?????y ?????!";
            return $this->getFormLogin($userName, $password, $message);
        }

        $user = $this->userModel->getLogin($userName, $password);



        if (isset($user['id'])) {

            // l??u session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION["user"] = $user;


            $baseUrl = BASE_URL;
            header("Location: $baseUrl");
            exit();
        } else {
            $message = "????ng nh???p th???t b???i!";
            return $this->getFormLogin($userName, $password, $message);
        }
    }
    function register($userName, $password, $name, $address, $email, $phone)
    {

        if ($userName == "" || $password == "" || $name == "" || $address == "" || $email == "") {
            $message = "Vui l??ng ??i???n ?????y ?????!";
            return $this->getFormRegister($userName, $password, $name, $address, $email, $phone, $message);
        }

        $register = $this->userModel->register($userName, $password, $name, $address, $email, $phone);

        if ($register['status'] == false) {
            $message = $register['message'];
            return $this->getFormRegister($userName, $password, $name, $address, $email, $phone, $message);
        } else {
            // l??u session
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
            $message = "C??c tr?????ng d??? li???u kh??ng ??????c b??? tr???ng!";
            return $this->index($message);
        }


        if (md5($password) != $_SESSION['user']['password']) {
            $message = "m???t kh???u kh??ng ch??nh x??c!";
            return $this->index($message);
        }
        if ($newPassword != $confirmPassword) {
            $message = "x??c th???c m???t kh???u m???i kh??ng kh???p!";
            return $this->index($message);
        }
        $edit = $this->userModel->edit($_SESSION['user']['id'], $newPassword, $name, $address, $email, $phone);

        $this->dataLayout();
        return $this->index($edit['message']);
    }
}
