<?php
class InvoiceRoute extends BaseRoutes
{
    private $invoiceCtrl;
    function __construct()
    {
        parent::__construct();
        $this->loadCtrl('Invoice');
        $this->invoiceCtrl = new InvoiceController();
    }


    function post()
    {
    }

    function get()
    {
        switch (true) {
            case preg_match('/^\/{0,1}$/', $this->path) != 0:
                return $this->invoiceCtrl->index();
            case preg_match('/^\/(detail\?id=)[0-9]{0,9}$/', $this->path) != 0:
                $invoiceId = $_GET['id'];
                return $this->invoiceCtrl->detail($invoiceId );
            default:
                return $this->baseCtrl->notFound();
        }
    }
}
