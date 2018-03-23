<?php

class Factory
{
    public function __construct()
    {
//      date_default_timezone_set(prc);
        require_once ('./core/Control.class.php');
        require_once ('./core/Modle.class.php');
        require_once ('./public/Page_class.php');
        //自动引用函数
        spl_autoload_register([__CLASS__,'loadControl']);
        spl_autoload_register([__CLASS__,'loadModle']);
        $this->run();
    }
    function loadControl($classname){
        $path="./control/".$classname.".class.php";
        if(file_exists($path)){
            require_once $path;
        }
        else{
            error_log('该文件不存在');
        }
    }
    function loadModle($classname){
        $path="./model/".$classname.".class.php";
        if(file_exists($path)){
            require_once $path;
        }
        else{
            error_log('该文件不存在');
        }
    }
    public function run(){
        //a控制c运行方法
        $a=isset($_GET['a'])?$_GET['a']:"Login";
        $c=isset($_GET['c'])?$_GET['c']:"showLogin";
        $con=$a."Con";
        $control=new $con();
        $control->doaction($c);
    }
}