<?php
$productImgFolder = 'upload/image/product/';

// var_dump($invoices);
?>

<div style="margin: 50px;;" class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Hoá đơn</h5>
        </div>
        <!-- Search -->

        <!-- /Search -->

        <div style="padding:10px;" class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th colspan="2">Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    foreach ($invoiceDetails as $invoiceDetail) {
                    ?>
                        <tr>
                            <td><?php echo $invoiceDetail['product']['name'] ?> </td>
                            <td>
                                <div class="card h-50 overflow-hidden">
                                    <img style="height:80px" src="<?php echo BASE_URL . $productImgFolder . $invoiceDetail['product']['images'][0]['filename'] ?>" alt="Avatar" />
                                </div>
                            </td>
                            <td> <?php echo $invoiceDetail['quantity'] ?></td>
                            <td><?php echo $invoiceDetail['product']['price']; ?></td>
                            <td><?php echo $invoiceDetail['quantity'] * $invoiceDetail['product']['price']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4"></td>
                        <td>
                            <div style="color:red">
                                <?php echo $total ?>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

</div>