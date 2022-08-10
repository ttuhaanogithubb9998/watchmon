<?php



class InvoiceDetail extends BaseModel
{
    const TABLE_NAME = 'invoicedetail';
    function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }



    function getAll()
    {
        return $this->all();
    }

    function add($invoiceId, $productId, $quantity)
    {
        return $this->insert([
            'invoiceId' => $invoiceId,
            'productId' => $productId,
            'quantity' => $quantity
        ]);
    }

    function getListByInvoice($invoiceId)
    {
        return  $this->search(["*"], [
            'invoiceId' => [$invoiceId,'=']
        ]);
    }
}
