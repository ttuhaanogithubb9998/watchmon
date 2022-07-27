<?php
class HomeController extends BaseController{

    function index (){

        $this->view('Home/index.php',[]);
       
    }

}