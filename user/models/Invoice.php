<?php



class Invoice extends BaseModel
{
    const TABLE_NAME = 'invoice';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }



    function getAll()
    {
        return $this->all();
    }

    
}

