<?php
class User extends BaseModel
{

    const TABLE_NAME = 'user';
    const SECRET_KEY = "my-secret-key";
    const TYPE_ENCRYPT = "aes128";
    private $iv = "qwertyuiopasdfgh";

    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }



    function getAll()
    {


        $result =  $this->all();
        // giả mã
        for ($i = 0; $i < count($result); $i++) {

            $result[$i]['phone'] = openssl_decrypt($result[$i]['phone'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $result[$i]['email'] = openssl_decrypt($result[$i]['email'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $result[$i]['address'] = openssl_decrypt($result[$i]['address'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        }
        return $result;
    }

    function getLogin($userName, $password)
    {
        $password = md5($password);

        $result =  $this->search(["*"], [
            'userName' => [$userName, '='],
            'password' => [$password, '=']
        ]);
        $user = isset($result[0]) ? $result[0] : "";
        // var_dump($user);
        // die();
        if (isset($user['id']) > 0 && $user["isAdmin"] == 1)
            return $user;
        return [];
    }

    function create($userName,$password, $name, $address, $email, $phone,$image,$state,$isAdmin)
    {
        
        // mã hoá 
        $password = md5($password);
        $phone =  openssl_encrypt($phone, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $email =  openssl_encrypt($email, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $address =  openssl_encrypt($address, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);


        $checkUserName = $this->search(["*"], ["userName" => [$userName, "="]]);

        $checkPhone = $this->search(["*"], ["phone" => [$phone, "="]]);

        if (count($checkUserName) > 0 || count($checkPhone) > 0) {
            $message = "Tên đăng nhập hoặc STD đã được sử dụng!";
            return ["status" => false, "message" => $message];
        }

        

        $insert = $this->insert([

            "userName" => $userName,
            "password" => $password,
            "name" => $name,
            "address" => $address,
            "phone" => $phone,
            "email" => $email,
            'state'=>$state,
            'isAdmin'=>$isAdmin,
            'image'=>$image,
        ]);
        if ($insert > 0) {

            $user = $this->search(["*"], ["userName" => [$userName, "="]])[0];

            $user['phone'] = openssl_decrypt($user['phone'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $user['email'] = openssl_decrypt($user['email'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $user['address'] = openssl_decrypt($user['address'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $message = "Thành công!";
            return   ['user' => $user, "status" => true, "message" => $message];
        }
        $message = "Lỗi ! Thất bại!";
        return   ['user' => '', "status" => false, "message" => $message];
    }

    function edit($userId,$password, $name, $address, $email, $phone,$image,$state,$isAdmin)
    {
        
        // mã hoá 
        $password = md5($password);
        $phone =  openssl_encrypt($phone, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $email =  openssl_encrypt($email, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $address =  openssl_encrypt($address, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);


        

        $update = $this->update([

            "password" => $password,
            "name" => $name,
            "address" => $address,
            "phone" => $phone,
            "email" => $email,
            'state'=>$state,
            'isAdmin'=>$isAdmin,
            'image'=>$image,
        ],$userId);
        if ($update > 0) {

            $user = $this->search(["*"], ["id" => [$userId, "="]])[0];

            $user['phone'] = openssl_decrypt($user['phone'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $user['email'] = openssl_decrypt($user['email'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $user['address'] = openssl_decrypt($user['address'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $message = "Thành công!";
            return   ['user' => $user, "status" => true, "message" => $message];
        }
        $message = "Lỗi ! Thất bại!";
        return   ['user' => '', "status" => false, "message" => $message];
    }

    function getUserById($userId){

        $user =  $this->search(['*'],['id'=>[$userId,'=']])[0];
        $user['phone'] = openssl_decrypt($user['phone'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $user['email'] = openssl_decrypt($user['email'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $user['address'] = openssl_decrypt($user['address'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        return $user;
    }

    
}
