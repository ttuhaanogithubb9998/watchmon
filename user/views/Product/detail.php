<?php
$productImgFolder = 'upload/image/product/';
?>
<div class="product-main">
    <div class="row content-row mb-0">

        <div class="product-gallery large-6 col">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    $i = 0;
                    foreach ($product['images'] as $img) {
                        $i++;
                        if ($i == 0) {
                    ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" class="active"></li>
                        <?php
                        } else {
                        ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"></li>
                    <?php

                        }
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($product['images'] as $img) {
                        if ($i == 0) {
                            $i++;
                    ?>
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?php echo BASE_URL . $productImgFolder . $img['filename'] ?>" alt="First slide">
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="carousel-item ">
                                <img class="d-block w-100" src="<?php echo BASE_URL . $productImgFolder . $img['filename'] ?>" alt="First slide">
                            </div>
                    <?php

                        }
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- .product-thumbnails -->
        </div>

        <div class="product-info summary col-fit col entry-summary product-summary">

            <h1 class="product-title entry-title">
                <?php echo $product['name'] ?>
            </h1>

            <div class="is-divider small"></div>
            <div class="price-wrapper">
                <p class="price product-page-price ">
                    <span class="woocommerce-Price-amount amount"><?php echo number_format($product['price']) ?>&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></span>
                </p>
            </div>
            <div class="product-short-description">
                <?php echo $product['description'] ?>
            </div>

            <?php
            if ($product['stock'] > 1&&$product['state']==1) {
            ?>
                <form class="cart" action="<?php echo BASE_URL . "cart/addMulti" ?>" method="post" enctype="multipart/form-data">
                    <div class="quantity buttons_added">
                        <input type="button" value="-" class="minus button is-form">
                        <input type="number" id="quantity_62ea71e29a9b6" class="input-text qty text" step="1" min="1" max="<?php echo $product['stock']?>" name="quantity" value="1" title="SL" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="">
                        <input type="button" value="+" class="plus button is-form">
                        <input type="hidden" name="productId" value="<?php echo $product['id'] ?>" />
                    </div>
                    <button type="submit" class="single_add_to_cart_button button alt">Thêm vào giỏ</button>
                </form>
            <?php
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    Hết hàng!
                </div>
            <?php
            }
            ?>


            <div class="product_meta">
                <span class="posted_in">Danh mục:
                    <?php
                    $i = 0;
                    foreach ($product['categories'] as $category) {
                        $i++;
                        if ($i != count($product['categories'])) {
                    ?>
                            <a href="<?php echo BASE_URL . "product/category?id=" . $category['id'] ?>" rel="tag"><?php echo $category['name'] ?></a>,
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo BASE_URL . "product/category?id=" . $category['id'] ?>" rel="tag"><?php echo $category['name'] ?></a>
                    <?php

                        }
                    }
                    ?>
                </span>
            </div>

        </div><!-- .summary -->

    </div><!-- .row -->
</div>