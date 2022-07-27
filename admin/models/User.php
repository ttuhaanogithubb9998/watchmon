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
}
