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

    function getId($productId)
    {
        return $this->search(["*"], ["id" => [$productId, '=']])[0];
    }

    /**
     * update stock 
     * @param int $id Product,
     * @param int $count 
     */
    function removeStock($id, $count)
    {
        $product =  $this->getId($id);
        $stock  = $product['stock'];

        if ($stock >= $count) {
            $stock = $stock - $count;
        } else {
            return false;
        }

        return $this->update(["stock" => $stock], $id);
    }

    /**
     * Xoá (khoá trạng thái)
     * @param int $id
     */
    function remove($id)
    {
        return $this->update(['state' => 0], $id);
    }

    /**
     * Khôi phục
     * @param int $id
     */
    function restore($id){
        return $this->update(['state' => 1], $id);
    }
}

class E_Product
{
    public $id;
}
