<?php
require_once "config.php";
require_once('./core/Database.php');
require_once('./core/Routers.php');
require_once('./admin/models/BaseModel.php');
require_once('./admin/controllers/BaseController.php');
require_once('./admin/routes/BaseRoutes.php');

require_once('./admin/routes/UserRoute.php');
require_once('./admin/routes/ProductRoute.php');
require_once('./admin/routes/HomeRoute.php');
require_once('./admin/routes/LoginRoute.php');
require_once('./admin/routes/LogoutRoute.php');

$routers = new Routers(new BaseController());

$routers->use('/',new HomeRoute());
$routers->use('/index',new HomeRoute());
$routers->use('/user',new UserRoute());
$routers->use('/product', new ProductRoute());
$routers->use('/login',new LoginRoute());
$routers->use('/logout',new LogoutRoute());








// $controllerName = ucfirst($_REQUEST);