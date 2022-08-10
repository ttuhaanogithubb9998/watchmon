<?php

// var_dump($invoices);
?>

<div style="margin: 50px;;" class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Hoá đơn</h5>
        </div>
        <!-- Search -->
        <div style="padding:10px" class="input-group input-group-merge">
            <input id="search" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
        </div>
        <!-- /Search -->

        <div style="padding:10px;" class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Mã hoá đơn</th>
                        <th>Tên</th>
                        <th>Thời gian</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Thanh toán</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    foreach ($invoices as $invoice) {
                    ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-0"></i> <strong class="name"><?php echo $invoice['id'] ?></strong></td>
                            <td><?php echo $invoice['name'] ?> </td>
                            <td> <?php echo $invoice['time'] ?></td>
                            <td><?php echo $invoice['address']; ?></td>
                            <td><?php echo $invoice['phone']; ?></td>
                            <td><?php echo $invoice['email']; ?></td>
                            <td><?php echo number_format($invoice['total'],0,'.',','); ?> ₫</td>
                            <td>
                                <a href="<?php echo BASE_URL . "admin/invoice/detail?id=" . $invoice['id'] ?>">Chi tiết</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
    let search = document.getElementById('search');
    console.log(search);
    search.onkeyup = function() {

        let textFind = this.value.toUpperCase();
        let trs = document.querySelectorAll('tbody tr');
        trs.forEach((tr) => {
            let name = tr.querySelector('tbody tr .name').innerText;
            let string = name + ' ';
            let categories = tr.querySelectorAll('tbody tr .category');

            categories.forEach((c) => {
                string += c.innerText + ' ';
            })

            if (string.toUpperCase().indexOf(textFind) != -1) {
                tr.style.display = 'table-row'
            } else {
                tr.style.display = 'none'
            }


            // console.log(textFind)

        })

    }
</script>