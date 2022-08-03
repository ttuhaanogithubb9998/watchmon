<?php
class UserController extends BaseController
{
    private $userModel;
    function __construct()
    {
        $this->loadModel("User");
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



    /**
     * GET
     */
    function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            $baseUrl = BASE_URL;
            header("Location: $baseUrl" . "user/login");
            exit();
        }



        $users = $this->userModel->getAll();

        return $this->view('User/index.php', [
            'users' => $users,
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


}
