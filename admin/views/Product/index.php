<?php
$productImgFolder = 'upload/image/product/';
$actionUrl = 'admin/product/';


// var_dump($products);
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Products</h5>
            <small class="text-muted float-end"><a href="<?php echo BASE_URL . $actionUrl . 'create' ?>">New Product</a></small>
        </div>
        <!-- Search -->
        <div style="padding:10px" class="input-group input-group-merge">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input id="search" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
        </div>
        <!-- /Search -->

        <div class="table-responsive text-nowrap">
            <table  class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody  class="table-border-bottom-0">
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-0"></i> <strong class="name"><?php echo $product['name'] ?></strong></td>
                            <td>
                                <div class="card h-50 overflow-hidden">
                                    <img style="height:80px" src="<?php echo BASE_URL . $productImgFolder . $product['images'][0]['filename'] ?>" alt="Avatar" />
                                </div>
                            </td>
                            <td>
                                <?php
                                foreach ($product['categories'] as $category) {
                                ?>
                                    <div class="category me-4"><?php echo $category['name']; ?></div>

                                <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo BASE_URL . $actionUrl . 'edit?id=' . $product['id'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="<?php echo BASE_URL . $actionUrl . 'delete?id=' . $product['id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
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
            let string = name+' ';
            let categories = tr.querySelectorAll('tbody tr .category');

            categories.forEach((c) => {
                string += c.innerText+' ';
            })

            if(string.toUpperCase().indexOf(textFind)!=-1){
                tr.style.display = 'table-row'
            }else{
                tr.style.display = 'none'
            }

            
            // console.log(textFind)

        })

    }
</script>