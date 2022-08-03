<?php
// var_dump($userName);
// var_dump($password);
// var_dump($message);
?>
<div style="margin-top:50px;margin-bottom:100px" class="row row-main ">
    <div class="large-12 col">
        <div class="col-inner">
            <div class="woocommerce">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="account-container lightbox-inner">
                    <div class="account-login-inner" style="max-width: 500px; margin: auto;">
                        <h3 class="uppercase">Đăng nhập</h3>
                        <form action="/user/login" class="woocommerce-form woocommerce-form-login login" method="post">
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="username">Tên tài khoản hoặc địa chỉ email&nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="userName" id="username" autocomplete="username" value="<?php echo $userName ?>">
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="password">Mật khẩu&nbsp;<span class="required">*</span></label>
                                <input value="<?php echo $password ?>" class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password">
                            </p>
                            <p class="form-row">
                                <button type="submit" class="woocommerce-Button button">
                                    Đăng nhập
                                </button>
                            <p class="text-danger text-center" style="color:#b41717"><?php echo $message ?></p>
                            <!-- <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Ghi nhớ mật khẩu</span>
                                </label> -->
                            </p>
                            <p class="woocommerce-LostPassword lost_password">
                                <a href="<?php echo BASE_URL . 'user/register' ?>">Đăng ký</a>
                            </p>
                        </form>
                    </div>
                    <!-- .login-inner -->
                </div>
                <!-- .account-login-container -->
            </div>
        </div>
        <!-- .col-inner -->
    </div>
    <!-- .large-12 -->
</div>