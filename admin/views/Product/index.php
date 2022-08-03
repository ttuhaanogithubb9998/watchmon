<?php
$productImgFolder = 'upload/image/product/';
$actionUrl = 'admin/product/';


// var_dump($products);
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Products</h5>
            <small class="text-muted float-end"><a href="<?php echo BASE_URL . $actionUrl . 'create'?>">New Product</a></small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
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
                <tbody class="table-border-bottom-0">
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-0"></i> <strong><?php echo $product['name'] ?></strong></td>
                            <td>
                                <div class="card h-50 overflow-hidden">
                                    <img style ="height:80px" src="<?php echo BASE_URL . $productImgFolder . $product['images'][0]['filename'] ?>" alt="Avatar"  />
                                </div>
                            </td>
                            <td>
                                <?php
                                foreach ($product['categories'] as $category) {
                                ?>
                                    <div class=" me-4"><?php echo $category['name']; ?></div>

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
                    <tr style="height:100px"></tr>
                </tbody>

            </table>
        </div>
    </div>

</div>