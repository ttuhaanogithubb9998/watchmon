<?php
class User extends BaseModel
{
    const TABLE_NAME = 'user';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }


    function getAll()
    {

        return $this->all();
    }

    function getLogin($userName, $password)
    {

        $user =  $this->search(["*"], [
            'userName' => [$userName, '='],
            'password' => [$password, '=']
        ]);
        if (count($user) > 0 && $user["isAdmin"] == 1)
            return $user;
        return [];
    }
}
