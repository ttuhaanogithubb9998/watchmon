<?php
 class Subimage extends BaseModel{
        const TABLE_NAME = 'subimage';
        function __construct(){
            parent::__construct(self::TABLE_NAME);
        }

        /*----------------------------------------------------------------*/
        /**
         * Lấy danh sách ảnh của sản phẩm
         *  @param int 
        */
        function getImages($productId){
            return $this->search(["*"],["productId"=>[$productId,"="]]);
        }
 }  