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


    
    function getLogin($userName, $password)
    {
        $password = md5($password);

        $users =   $this->search(["*"], [
            'userName' => [$userName, '='],
            'password' => [$password, '=']
        ]);

        if (isset($users[0])) {

            $user = $users[0];
            $user['phone'] = openssl_decrypt($user['phone'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $user['email'] = openssl_decrypt($user['email'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
            $user['address'] = openssl_decrypt($user['address'], self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);

            return $user;
        }
        return false;
    }

    /**
     * @return array - ['user'=>$user, 'status'=>false|true, 'message'=>$message];
     */
    function register($userName, $password, $name, $address, $email, $phone)
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
            return ['user' => "", "status" => false, "message" => $message];
        }

        $insert = $this->insert([

            "userName" => $userName,
            "password" => $password,
            "name" => $name,
            "address" => $address,
            "phone" => $phone,
            "email" => $email
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


    /**
     * 
     */
    function edit($userId, $password, $name, $address, $email, $phone)
    {
        
        $password = md5($password);
        $phone =  openssl_encrypt($phone, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $email =  openssl_encrypt($email, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);
        $address =  openssl_encrypt($address, self::TYPE_ENCRYPT, self::SECRET_KEY, 0, $this->iv);

       

        $update = $this->update([

            "password" => $password,
            "name" => $name,
            "address" => $address,
            "phone" => $phone,
            "email" => $email
        ], $userId);
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
