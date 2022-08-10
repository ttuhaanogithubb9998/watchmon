<?php
class UserRoute extends BaseRoutes
{
    private $userCtrl;
    function __construct()
    {
        parent::__construct();
        $this->loadCtrl('User');
        $this->userCtrl = new UserController();
    }




    function get()
    {
        switch (true) {
            case preg_match('/^(\/){0,1}$/', $this->path) != 0:
                return $this->userCtrl->index();
            case preg_match('/^(\/create)$/', $this->path) != 0:
                return $this->userCtrl->getFormCreate();
            case preg_match('/^(\/edit\?id=)[0-9]{1,10}$/', $this->path) != 0:
                $userId = isset($_GET['id']) ? $_GET['id'] : "";
                return $this->userCtrl->getFormEdit($userId);
            default:
                return $this->baseCtrl->notFound();
        }
    }


    function post()
    {
        switch (true) {

            case preg_match('/^(\/create)$/', $this->path) != 0:

                $userName = isset($_POST['userName']) ? trim($_POST['userName']) : "";
                $password = isset($_POST['password']) ? trim($_POST['password']) : "";
                $name = isset($_POST['name']) ? trim($_POST['name']) : "";
                $address = isset($_POST['address']) ? trim($_POST['address']) : "";
                $email = isset($_POST['email']) ? trim($_POST['email']) : "";
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
                $image = isset($_FILES['image']) ? $_FILES['image'] : [];
                $state = isset($_POST['state']) ? trim($_POST['state']) : 0;
                $isAdmin = isset($_POST['isAdmin']) ? trim($_POST['isAdmin']) : 0;
                return $this->userCtrl->create($userName, $password, $name, $address, $email, $phone, $image, $state, $isAdmin);

            case preg_match('/^(\/edit)$/', $this->path) != 0:
                
                $userId = isset($_POST['id']) ? trim($_POST['id']) : "";
                $password = isset($_POST['password']) ? trim($_POST['password']) : "";
                $name = isset($_POST['name']) ? trim($_POST['name']) : "";
                $address = isset($_POST['address']) ? trim($_POST['address']) : "";
                $email = isset($_POST['email']) ? trim($_POST['email']) : "";
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
                $image = isset($_FILES['image']) ? $_FILES['image'] : [];
                $state = isset($_POST['state']) ? trim($_POST['state']) : 0;
                $isAdmin = isset($_POST['isAdmin']) ? trim($_POST['isAdmin']) : 0;
                return $this->userCtrl->edit($userId, $password, $name, $address, $email, $phone, $image, $state, $isAdmin);

            default:
                return $this->baseCtrl->notFound();
        }
    }
}
