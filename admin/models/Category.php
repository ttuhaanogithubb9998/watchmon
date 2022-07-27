<?php
class Category extends BaseModel
{
    const TABLE_NAME = 'category';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    function getAll()
    {
        return $this->all();
    }

    /**
     * @param int $categoryId
     * @return category | false
     */
    function getCategory($categoryId)
    {
        $result =  $this->search(["*"], ['id' => [$categoryId, '=']]);
        if ($result) return $result[0];
        return false;
    }
}
