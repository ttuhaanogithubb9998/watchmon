<?php 
class InvoiceDetail extends BaseModel{

    const TABLE_NAME = 'invoicedetail';
    function __construct(){
        parent::__construct(self::TABLE_NAME);
    }

    function getAll (){
        return $this->all(null,null,null);
        
    }
    
    function getListByInvoice($invoiceId)
    {
        return  $this->search(["*"], [
            'invoiceId' => [$invoiceId,'=']
        ]);
    }

}