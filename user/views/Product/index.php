<?php
// var_dump($categories);
// var_dump($products);
// var_dump($numberMaxPage);
// var_dump($indexPage);
?>
<div class="row category-page-row">

	<div class="col large-3 hide-for-medium ">
		<div id="shop-sidebar" class="sidebar-inner col-inner">
			<aside id="woocommerce_product_categories-3" class="widget woocommerce widget_product_categories"><span class="widget-title shop-sidebar">Danh mục sản phẩm</span>
				<div class="is-divider small"></div>
				<ul class="product-categories">
					<?php
					foreach ($categories as $category) {
					?>
						<li class="cat-item cat-item-37"><a href="product/category?id=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
					<?php
					}
					?>
					<!-- <li class="cat-item cat-item-31 current-cat active"><a href="http://mauweb.monamedia.net/rolex/danh-muc/san-pham-hot/">Sản phẩm Hot</a></li> -->
				</ul>
			</aside>
		</div><!-- .sidebar-inner -->
	</div><!-- #shop-sidebar -->

	<div class="col large-9">
		<div class="shop-container">

			<div class="woocommerce-notices-wrapper"></div>
			<div class="products row row-small large-columns-3 medium-columns-3 small-columns-2 has-shadow row-box-shadow-1 row-box-shadow-2-hover">
				<?php
				foreach ($products as $product) {
				?>
					<div class="product-small col has-hover post-567 product type-product status-publish has-post-thumbnail product_cat-dong-ho-nu product_cat-sale product_cat-san-pham-hot product_tag-men product_tag-rolex instock sale shipping-taxable purchasable product-type-simple">
						<div class="col-inner">
							<?php
							if ($product['sale']) {
							?>
								<div class="badge-container absolute left top z-1">
									<div class="callout badge badge-circle">
										<div class="badge-inner secondary on-sale"><span class="onsale">-<?php echo 100 - (int)$product['priceSale'] ?>%</span></div>
									</div>
								</div>
							<?php
							}
							?>

							<div class="product-small box ">
								<div class="box-image">
									<div class="image-fade_in_back">
										<a href="<?php echo BASE_URL . 'product/?id=' . $product['id']; ?>">
											<img width="480" height="480" src="<?php echo BASE_URL . $productImgFolder . $product['images'][0]['filename'] ?>" />
											<?php
											if (isset($product['images'][1])) {
											?>
												<img class="show-on-hover absolute fill hide-for-small back-image" width="480" height="480" src="<?php echo BASE_URL . $productImgFolder . $product['images'][1]['filename'] ?>" />

											<?php
											}

											?>
										</a>
									</div>
									<div class="image-tools top right show-on-hover">
									</div>
									<div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
										<a rel="nofollow" id="<?php echo $product['id'] ?>" class="add_to_cart_button add-to-cart-grid no-padding" style="width:0;display:block;cursor: pointer;">
											<div class="cart-icon tooltip absolute is-small tooltipstered"><strong>+</strong></div>
										</a>
										<?php
										// check user đã mua sp hay chưa
										if (isset($user['carts'][0])) {
											$checkC  = false;
											foreach ($user['carts'] as $c) {
												if (is_array($c)&&$c['productId'] == $product['id']) {
													$checkC = true;
													break;
												}
											}
											if ($checkC) {
										?>
												<div class='link-cart' style="width:100%">
													<a href="/cart" class="added_to_cart wc-forward" title="Xem giỏ hàng">Xem giỏ hàng</a>
												</div>
											<?php
											} else {
											?>
												<div class='link-cart' style="width:100%">
												</div>
										<?php
											}
										}
										?>

									</div>
								</div><!-- box-image -->

								<div class="box-text text-center">
									<div class="title-wrapper">
										<p class="name product-title">
											<a href="<?php echo BASE_URL . 'product/?id=' . $product['id'] ?>">
												<?php echo $product['name'] ?>
											</a>
										</p>
									</div>
									<div class="price-wrapper">
										<span class="price">
											<?php
											if ($product['sale']) {
											?>
												<del>
													<span class="woocommerce-Price-amount amount">
														<?php echo number_format($product['price'] * $product['priceSale'] / 100, 0, '.', ',') ?>&nbsp;
														<span class="woocommerce-Price-currencySymbol">₫
														</span>
													</span>
												</del>
											<?php
											}
											?>
											<ins>
												<span class="woocommerce-Price-amount amount">
													<?php echo number_format($product['price'], 0, '.', ',') ?>&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span>
												</span>
											</ins>
										</span>
									</div>
								</div><!-- box-text -->
							</div><!-- box -->
						</div><!-- .col-inner -->
					</div><!-- col -->
				<?php
				}
				?>


			</div><!-- row -->
			<div class="container">
				<nav class="woocommerce-pagination">
					<ul style="justify-content: center;display: flex;" class="page-numbers nav-pagination links text-center">
						<?php
						if ($numberMaxPage > 1) {
							if ($indexPage > 1) {
						?>
								<li><a style="align-items: center;display: flex;justify-content: center" class="previous page-number" href="/product/page?id=<?php echo $indexPage - 1 ?>"><i class="icon-angle-left"></i></a></li>
							<?php
							}
							?>
							<li><span aria-current="page" class="page-number current"><?php echo $indexPage ?></span></li>
							<?php

							if ($indexPage < $numberMaxPage) {
							?>
								<li><a style="align-items: center;display: flex;justify-content: center" class="previous page-number" href="/product/page?id=<?php echo $indexPage + 1 ?>"><i class="icon-angle-right"></i></a></li>
						<?php

							}
						}
						?>
					</ul>
				</nav>
			</div>
		</div><!-- shop container -->
	</div>
</div>