<?php

class Factory
{
    public function __construct()
    {
//  	data_defalult_timezone_set(prc);
        require_once "./core/Control.class.php";
        require_once "./core/Model.class.php";
        require_once "./public/SplitPage.class.php";
        spl_autoload_register([__CLASS__,'loadControl']);
        spl_autoload_register([__CLASS__,'loadModel']);
        $this->run();
    }
    //文件的引用
    function loadControl($classname){
        $path = "./control/{$classname}.class.php";
        if(file_exists($path)){
            require_once "$path";
        }
    }
    //模块的引用
    function loadModel($classname){
        $path = "./model/{$classname}.class.php";
        if(file_exists($path)){
            require_once "$path";
        }
    }
    //工厂的路由和初始化
    public function run(){
        //获取url上的参数
        $type = isset($_GET["type"])?$_GET["type"]:'homepage';
        $cont = isset($_GET["cont"])?$_GET["cont"]:'homepage';
        $con = $type."Con";
        $control = new $con();
        $control->doaction($cont);
    }
}