<?php
include "config.php";
require_once('./core/Database.php');
require_once('./core/Routers.php');
require_once('./user/models/BaseModel.php');
require_once('./user/controllers/BaseController.php');
require_once('./user/routes/BaseRoutes.php');

require_once('./user/routes/UserRoute.php');
require_once('./user/routes/ProductRoute.php');
require_once('./user/routes/HomeRoute.php');
require_once('./user/routes/CartRoute.php');

$routers = new Routers(new BaseController());


$routers->use('/',new HomeRoute);
$routers->use('/index',new HomeRoute);
$routers->use('/user',new UserRoute());
$routers->use('/product', new ProductRoute());
$routers->use('/cart', new CartRoute());




