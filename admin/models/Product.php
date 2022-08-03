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

    function getProduct($productId)
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
        $product =  $this->getProduct($id);
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
    function restore($id)
    {
        return $this->update(['state' => 1], $id);
    }

    /**
     * @return product | false
     */
    function create($name, $description, $price, $priceSale, $stock, $state)
    {
        $insert =  $this->insert([
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "priceSale" => $priceSale,
            "stock" => $stock,
            "state" => $state
        ]);

        if ($insert > 0)  return $this->search(["*"], [
            "name" => [$name, "="],
            "description" => [$description, "="],
            "price" => [$price, "="],
            "priceSale" => [$priceSale, "="],
            "stock" => [$stock, "="],
            "state" => [$state, "="]
        ])[0];

        return false;
    }

    /**
     * 
     */
    function edit($productId,$name, $description, $price, $priceSale, $stock, $state){
        return $this->update([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'priceSale' => $priceSale,
            'stock' => $stock,
            'state'=> $state
        ],$productId);
    }
}

