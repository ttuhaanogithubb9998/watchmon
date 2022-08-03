<?php
class Cart extends BaseModel
{
    const TABLE_NAME = 'cart';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    function getAll()
    {
        return $this->all();
    }

    /**
     * @param int $cartId
     * @return cart | false
     */
    function getCart($cartId)
    {
        $result =  $this->search(["*"], ['id' => [$cartId, '=']]);
        if ($result) return $result[0];
        return false;
    }

    /**
     * @param int $userId 
     * @return array the carts 
     */
    function getCartsByUser($userId)
    {
        $result =  $this->search(["*"], ['userId' => [$userId, '=']]);
        if (count($result) > 0) return $result;
        return [];
    }
    function getCartsByUserAndProduct($userId,$productId)
    {
        // var_dump($productId);
        $result =  $this->search(["*"], ['userId' => [$userId, '='],"productId"=>[$productId,"="]]);
        if (count($result) > 0) return $result;
        return [];
    }
    

    function add($userId,$productId,$quantity){
        return $this->insert([
            "userId"=>$userId, 
            "productId"=>$productId,
            "quantity" =>$quantity]
        );
    }

    function changeQuantity($quantity,$cartId){
        return $this->update(['quantity'=>$quantity],$cartId);
        
    }
    
}
