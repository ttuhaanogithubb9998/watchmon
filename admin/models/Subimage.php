<?php
class Subimage extends BaseModel
{
    const TABLE_NAME = 'subimage';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    /*----------------------------------------------------------------*/
    /**
     * Lấy danh sách ảnh của sản phẩm
     * @param int $productId 
     *  @return SubImages - danh sách các ảnh của product
     */
    function getImages($productId)
    {
        return $this->search(["*"], ["productId" => [$productId, "="]]);
    }

    /**
     * @param int $productId
     * @param string $fileName 
     * @return int | false số dòng ảnh hưởng hoặc false
     */
    function addImage($productId, $fileName)
    {
        return  $this->insert([
            "productId" => $productId,
            "filename" => $fileName,
        ]);
    }
}
