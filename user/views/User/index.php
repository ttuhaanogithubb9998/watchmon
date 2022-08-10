<div class="row category-page-row">

    <div class="col large-3 hide-for-medium ">
        <div id="" class="sidebar-inner col-inner">
            <aside id="woocommerce_product_categories-3" class="widget woocommerce widget_product_categories">
                <h2 class="text-center">Tài Khoản</h2>
                <div>
                    <img src="<?php echo BASE_URL . "upload/image/user/{$user['image']}" ?>" alt="" />
                </div>
                <ul class="list-group">

                    <li class="list-group-item"><a href="<?php echo BASE_URL . 'cart' ?>">Giỏ hàng</a></li>
                    <li class="list-group-item"><a href="<?php echo BASE_URL . 'user/invoice' ?>">Hoá đơn</a></li>

                    <!-- <li class="cat-item cat-item-31 current-cat active"><a href="http://mauweb.monamedia.net/rolex/danh-muc/san-pham-hot/">Sản phẩm Hot</a></li> -->
                </ul>
                <div class="text-center" style="padding:20px;">
                    <button class="btn btn-danger" style="margin:auto;color:white">
                        <a style="margin:auto;color:white" href="<?php echo BASE_URL ?>user/logout"> đăng xuất</a>
                    </button>
                </div>
            </aside>
        </div><!-- .sidebar-inner -->
    </div><!-- #shop-sidebar -->

    <div class="col large-9">
        <div style="margin-top:50px;" class="shop-container">
            <form action="<?php echo BASE_URL . 'user/edit' ?>" method="post">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Tên đăng nhập :</label>
                    <div class="col-sm-10">
                        <div class="h-100" style="padding:6px"><?php echo $user['userName'] ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password :</label>
                    <div style="display:flex;justify-content:space-between" class="col-sm-10">
                        <div class="h-100 label" style="padding:6px">**********</div>
                        <div class="info" style="display:none;width:100%;">
                            <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                            <input name="newPassword" type="password" class="form-control" placeholder="New Password">
                            <input name="confirmPassword" type="password" class="form-control" placeholder="Confirm password">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Tên :</label>
                    <div style="display:flex;justify-content:space-between" class="col-sm-10">
                        <div class="h-100 label" style="padding:6px"> <?php echo $user['name'] ?></div>
                        <div class="info" style="display:none;width:100%;">
                            <input value="<?php echo $user['name'] ?>" name="name" id="name" type="text" class="form-control" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email : </label>
                    <div style="display:flex;justify-content:space-between" class="col-sm-10">
                        <div class="h-100 label" style="padding:6px"> <?php echo $user['email'] ?></div>
                        <div class="info" style="display:none;width:100%;">
                            <input value="<?php echo $user['email'] ?>" name="email" id="email" type="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Địa chỉ :</label>
                    <div style="display:flex;justify-content:space-between" class="col-sm-10">
                        <div class="h-100 label" style="padding:6px"> <?php echo $user['address'] ?></div>
                        <div class="info" style="display:none;width:100%;">
                            <input value="<?php echo $user['address'] ?>" name="address" id="address" type="text" class="form-control" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Số điện thoại :</label>
                    <div style="display:flex;justify-content:space-between" class="col-sm-10">
                        <div class="h-100 label" style="padding:6px"> <?php echo $user['phone'] ?></div>
                        <div class="info" style="display:none;width:100%;">
                            <input value="<?php echo $user['phone'] ?>" name="phone" id="phone" type="text" class="form-control" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div style="display:flex;justify-content:end" class>
                    <button style="background:#589bff;margin:0" class='btn btn-primary' id='btnEdit' type="button">Chỉnh sửa</button>
                    <button id='btnSave' style="display:none;background:#589bff;margin:0" type="submit" class="btn btn-primary">Lưu</button>
                </div>
                <div class="text-center">
                    <p class="text-danger"><?php echo $message; ?></p>
                </div>
            </form>
        </div><!-- shop container -->
    </div>
</div>

<script type="text/javascript">
    let btnEdit = document.getElementById('btnEdit');
    let btnSave = document.getElementById('btnSave');
    btnEdit.onclick = () => {

        btnEdit.style.display = 'none';
        btnSave.style.display = 'block';
        
        
        document.querySelectorAll('.label').forEach(element => {
            let group = element.parentElement;
            let info = group.querySelector('.info')

            element.style.display = 'none'
            info.style.display = 'block'
        });

    }
</script>