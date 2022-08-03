<?php
$productImgFolder = 'upload/image/product/';

?>
<div style="margin-top:50px;margin-bottom:100px" class="row row-main">
    <div class="large-12 col">
        <div class="col-inner">



            <div class="woocommerce">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="woocommerce row row-large row-divided">
                    <div class="col  pb-0 ">


                        <form class="woocommerce-cart-form" action="http://mauweb.monamedia.net/rolex/gio-hang/" method="post">
                            <div class="cart-wrapper sm-touch-scroll">


                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-name" colspan="3">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($user['carts'] as $cart) {
                                            if (is_array($cart)) {
                                        ?>
                                                <tr class=" woocommerce-cart-form__cart-item cart_item">

                                                    <td class="product-remove">
                                                        <a style = "cursor: pointer;"class="removeAll remove" aria-label="Xóa sản phẩm này" data-product_id="563" data-product_sku="69111">×</a>
                                                    </td>

                                                    <td class="product-thumbnail">
                                                        <a href="<?php echo BASE_URL . "product/detail?id=" . $cart['product']['id'] ?>">
                                                            <img width="480" height="480" src="<?php echo BASE_URL . $productImgFolder . $cart['product']['images'][0]['filename'] ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="">
                                                        </a>
                                                    </td>

                                                    <td class="product-name" data-title="Sản phẩm">
                                                        <a href="<?php echo BASE_URL . "product/detail?id=" . $cart['product']['id'] ?>">
                                                            <?php echo $cart['product']['name'] ?>
                                                        </a>
                                                    </td>

                                                    <td class="product-price" data-title="Giá">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <?php echo number_format($cart['product']['price'], 0, '.', ',') ?>&nbsp;
                                                            <span class="woocommerce-Price-currencySymbol">₫</span>
                                                        </span>
                                                    </td>

                                                    <td class="product-quantity" data-title="Số lượng">
                                                        <?php
                                                        if ($cart['product']['stock'] < $cart['quantity']) {
                                                        ?>
                                                            <div id="<?php echo $cart['id'] ?>" class="changeQuantity" style="display:flex;align-items: center;font-weight: bold;color: red;">
                                                                <p class="removeQuantity" style="padding-inline:10px;cursor: pointer;">-</p>
                                                                <p class="quantity errorQuantity" style="padding-inline:20px;color: red;"><?php echo $cart['quantity'] . '/' . $cart['product']['stock'] ?></p>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div id="<?php echo $cart['id'] ?>" class="changeQuantity" style="display:flex;align-items: center;font-weight: bold;color: black;">
                                                                <p class="removeQuantity" style="padding-inline:10px;cursor: pointer;">-</p>
                                                                <p class="quantity" style="padding-inline:20px;"><?php echo $cart['quantity'] ?></p>
                                                                <p class="addQuantity" style="padding-inline:10px;cursor: pointer;">+</p>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td class="product-subtotal" data-title="Tổng">
                                                        <span class="sum woocommerce-Price-amount amount">
                                                            <?php echo number_format($cart['product']['price'] * $cart['quantity'], 0, '.', ',') ?>&nbsp;
                                                            <span class="woocommerce-Price-currencySymbol">₫</span>
                                                        </span>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <span id="total" style="color:#d00e0e" class="woocommerce-Price-amount amount"><?php echo number_format($user['carts']['total'], 0, '.', ',') ?>&nbsp;<span style="color:#d00e0e" class="woocommerce-Price-currencySymbol">₫</span></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="">
                                                <div style="text-align:center">
                                                    <a href="/cart/oder" class="button primary mt-0 pull-left small">Đặt hàng</a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="cart-footer-content after-cart-content relative"></div>
            </div>


        </div><!-- .col-inner -->
    </div><!-- .large-12 -->
</div>

<script type="text/javascript">
    document.querySelectorAll('.cart_item').forEach((element) => {
        let cartId = element.querySelector('.changeQuantity').id;
        let remove = element.querySelector('.removeQuantity');
        let add = element.querySelector('.addQuantity');
        let quantity = element.querySelector('.quantity');
        let sum = element.querySelector('.sum');
        let total = document.querySelector("#total");
        let removeAll =element.querySelector('.removeAll');

        // console.log(cartId);
        // console.log(sum);
        remove.onclick = function() {
            $.ajax({
                url: '/cart/remove',
                data: {
                    cartId
                },
                method: 'POST',
            }).done((result) => {
                let data = JSON.parse(result.replace('<!--  -->', "").trim());
                console.log(data);
                if (data.code == 200) {
                    if (data.quantity == 0) {
                        element.remove();
                    } else {
                        quantity.innerHTML = data.quantity;
                        sum.innerHTML = (data.price * data.quantity).toLocaleString('en-US') + " ₫";

                        if (data.quantity > data.stock) {
                            add.remove();
                            quantity.style.color = 'red';

                        }

                    }

                    total.innerHTML = data.total.toLocaleString('en-US') + " ₫"
                } else {
                    alert(data.message);
                }
            })
        }

        add.onclick = function() {

            $.ajax({
                url: '/cart/add',
                data: {
                    cartId
                },
                method: 'POST',
            }).done((result) => {
                let data = JSON.parse(result.replace('<!--  -->', "").trim());
                console.log(data);
                if (data.code == 200) {
                    if (data.quantity == 0) {
                        element.remove();
                    } else {
                        quantity.innerHTML = data.quantity;
                        sum.innerHTML = (data.price * data.quantity).toLocaleString('en-US') + " ₫";

                        if (data.quantity > data.stock) {
                            add.remove();
                            quantity.style.color = 'red';

                        }

                    }
                    total.innerHTML = data.total.toLocaleString('en-US') + " ₫"

                } else {
                    alert(data.message);
                }


            })

        }

        removeAll.onclick=function(){
            $.ajax({
                url:"/cart/remove_all",
                data:{cartId},
                method:"POST",
                
            }).done((result) => {
                let data = JSON.parse(result.replace('<!--  -->', "").trim());
                console.log(data);
                if (data.code == 200) {
                    if (data.quantity == 0) {
                        element.remove();
                    } else {
                        quantity.innerHTML = data.quantity;
                        sum.innerHTML = (data.price * data.quantity).toLocaleString('en-US') + " ₫";

                        if (data.quantity > data.stock) {
                            add.remove();
                            quantity.style.color = 'red';

                        }

                    }

                    total.innerHTML = data.total.toLocaleString('en-US') + " ₫"
                } else {
                    alert(data.message);
                }
            })
        }
    })
</script>