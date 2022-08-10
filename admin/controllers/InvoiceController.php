<?php
class InvoiceController extends BaseController
{
    private $invoiceModel;
    private $invoiceDetailModel;
    function __construct()
    {
        $this->loadModel('Invoice');
        $this->invoiceModel = new Invoice();
        $this->loadModel('InvoiceDetail');
        $this->invoiceDetailModel = new InvoiceDetail();
    }

    function index()
    {

        $invoices = $this->invoiceModel->getAll();

        $this->view('Invoice/index.php', [
            'invoices' => $invoices
        ]);
    }

    function detail($invoiceId)
    {
        $this->loadModel('Product');
        $this->loadModel('Subimage');
        $productModel = new Product();
        $subImageModel = new Subimage();



        $invoice = $this->invoiceModel->getInvoice($invoiceId)[0];
        $total = $invoice['total'];
        $invoiceDetails = $this->invoiceDetailModel->getListByInvoice($invoiceId);

        for ($i = 0; $i < count($invoiceDetails); $i++) {
            $product = $productModel->getProduct($invoiceDetails[$i]['productId']);
            $images = $subImageModel->getImages($product['id']);
            $product['images'] = $images;

            $invoiceDetails[$i]['product'] = $product;
        }

        return $this->view('Invoice/detail.php', [
            'invoiceDetails' => $invoiceDetails,
            'total' => $total
        ]);
    }
}
