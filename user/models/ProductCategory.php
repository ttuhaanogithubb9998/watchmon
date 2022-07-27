<?php 
 class ProductCategory extends BaseModel{
    const TABLE_NAME = 'product_category';
    function __construct(){
        parent::__construct(self::TABLE_NAME);
    }

    function getAll(){
        return $this->all();
    }

    function getListByProduct($productId){
        return $this->search(["*"],['productId',[$productId]]);
    }

    function getListByCategory($categoryId){
        return $this->search(["*"],['categoryId'=>[$categoryId,'=']]);
    }

    
 }