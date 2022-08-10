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


    function getFormCreate($userName = "", $password = "", $name = "", $address = "", $email = "", $phone = "", $message = "", $type = "primary")
    {

        return $this->view("User/create.php", [
            'userName' => $userName,
            'password' => $password,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
            'type' => $type
        ]);
    }

    function getFormEdit($userId, $message = "",$type = "primary")
    {

        $userEdit = $this->userModel->getUserById($userId); 
        
        

        return $this->view("User/edit.php", [
            'userEdit' => $userEdit,
            'message' => $message,
            'type'=> $type
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
            header("Location: $baseUrl" . "admin");
            exit();
        } else {
            $message = "Đăng nhập thất bại!";
            return $this->getFormLogin($userName, $password, $message);
        }
    }



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

    function create($userName, $password, $name, $address, $email, $phone, $image, $state, $isAdmin)
    {
        $pathUpload = ROOT . '/upload/image/user/';


        if ($userName == '' || $password == '' || $name == '' || $address == '' || $email == '' || $phone == '' || $image['name'] == '') {
            $message = "Hãy nhập đầy đủ thông tin";
            return $this->getFormCreate($message, "danger");
        }

        if (getimagesize($image['tmp_name']) === false) {
            $message = "Định dạng ảnh không hợp lệ";
            return $this->getFormCreate($message, 'danger');
        }

        $extensionImg = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $randomNameImg  = md5((new DateTime())->format('Y-m-d H:i:s.u'));
        $fileName = $randomNameImg . '.' . $extensionImg;
        $targetPath = $pathUpload . $fileName;
        $loaded = move_uploaded_file($image['tmp_name'], $targetPath);

        if ($loaded) {


            $create =  $this->userModel->create($userName, $password, $name, $address, $email, $phone, $fileName, $state, $isAdmin);
            if ($create['status']) {
                return $this->getFormCreate("Thành công!");
            }

            return $this->getFormCreate("Thất bại!", "danger");
        }

        return $this->getFormCreate("Thất bại!", "danger");
    }

    function edit($userId, $password, $name, $address, $email, $phone, $image, $state, $isAdmin)
    {
        $pathUpload = ROOT . '/upload/image/user/';

        if ( $password == '' || $name == '' || $address == '' || $email == '' || $phone == '' || $image['name'] == '') {
            $message = "Hãy nhập đầy đủ thông tin";
            return $this->getFormEdit($userId,$message, "danger");
        }

        if (getimagesize($image['tmp_name']) === false) {
            $message = "Định dạng ảnh không hợp lệ";
            return $this->getFormEdit($userId,$message, 'danger');
        }

        $extensionImg = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $randomNameImg  = md5((new DateTime())->format('Y-m-d H:i:s.u'));
        $fileName = $randomNameImg . '.' . $extensionImg;
        $targetPath = $pathUpload . $fileName;
        $loaded = move_uploaded_file($image['tmp_name'], $targetPath);

        if ($loaded) {
            $user = $this->userModel->getUserById($userId);

            $edit =  $this->userModel->edit($userId,  $password, $name, $address, $email, $phone, $fileName, $state, $isAdmin);
            if ($edit['status']) {
                unlink($pathUpload . $user['image']);

                return $this->getFormEdit($userId,"Thành công!");
            }

            return $this->getFormEdit($userId,"Thất bại!", "danger");
        }

        return $this->getFormEdit($userId,"Thất bại!", "danger");
    }
}
