<?php
class UserController extends BaseController
{
    private $userModel;
    function __construct()
    {
        $this->loadModel("User");
        $this->userModel = new User();
    }

    function index()
    {

        $users = $this->userModel->getAll();

        $this->view('User/index.php', [
            'users' => $users,
        ]);
    }

    function getFormLogin($userName = '', $password = "", $message = '')
    {
        return $this->view("", [
            'userName' => $userName,
            'password' => $password,
            'message' => $message
        ], ROOT . '/admin/views/login.php');
    }

    function login($userName, $password)
    {


        if ($userName == "" || $password == "") {
            $message = "Vui lòng điền đầy đủ!";
            return $this->getFormLogin($userName, $password, $message);
        }

        $data = $this->userModel->getLogin($userName, $password);

        if (count($data) > 0) {

            // lưu session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["user"] = $data[0];


            $baseUrl = BASE_URL;
            header("Location: $baseUrl" . "admin");
            exit();
        } else {
            $message = "Đăng nhập thất bại!";
            return $this->getFormLogin($userName, $password, $message);
        }
    }


    /**
     * 
     */
    function Logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        $baseUrl = BASE_URL;
        header("Location: $baseUrl" . "admin/login");
    }
}
