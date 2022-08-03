<div class="row row-main">
    <div class="large-12 col">
        <div class="col-inner">



            <div class="woocommerce">
                <form action="" method="post">
                    <div class="row pt-0 ">
                        <div class="large-7 col  ">
                            <h1 style="margin-top:50px">THÔNG TIN THANH TOÁN</h1>

                            <form >
                                <div class="form-group">
                                    <label for="name">Tên</label>
                                    <input name="name" type="text" class="form-control" id="name" value="<?php echo $user['name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input name="address" value="<?php echo $user['address'] ?>" type="text" class="form-control" id="address">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" value="<?php echo $user['email'] ?>" type="text" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input name="phone" value="<?php echo $user['phone'] ?>" type="text" class="form-control" id="phone">
                                </div>
                                <div class="form-group">
                                    <label for="description">Ghi chú</label>
                                    <textarea name="description" type="text" class="form-control" id="description">
                                    </textarea>
                                </div>
                            </form>

                        </div>
                        <!-- large-7 -->

                        <div style="margin-top:50px" class="large-5 col">

                            <div class="col-inner has-border">
                                <div class="checkout-sidebar sm-touch-scroll">
                                    <h3 id="order_review_heading">Đơn hàng của bạn</h3>


                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Sản phẩm</th>
                                                    <th class="product-total">Tổng</th>
                                                </tr>   
                                            </thead>
                                            <tbody>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        BIG BANG MXM18 SANG BLEU 39&nbsp; <strong class="product-quantity">× 1</strong> </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount">739,370,000&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>Thành tiền</th>
                                                    <td><span class="woocommerce-Price-amount amount">765,900,000&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></span></td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <button type="submit"> Thanh toán </button>
                                    </div>

                                    <div class="woocommerce-privacy-policy-text"></div>
                                </div>
                            </div>

                        </div><!-- large-5 -->

                    </div>
                </form>
                <!-- row -->
            </div>


        </div><!-- .col-inner -->
    </div><!-- .large-12 -->
</div>