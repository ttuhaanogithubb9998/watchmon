<?php



class Product extends BaseModel
{
    const TABLE_NAME = 'product';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }



    function getAll()
    {
        return $this->all();
    }

    /**
     * @param  int $productId 
     * @return product | false
     */
    function getProduct($productId)
    {
        return $this->search(["*"], ["id" => [$productId, '=']])[0];
    }

    /**
     * 
     */
    function getListLimit($startLimit, $numberOf)
    {
        return $this->all(["*"], [], $startLimit . "," . $numberOf);
    }

    function getCountAll(){
        return $this->getCount();
    }
}

class E_Product
{
    public $id;
}
