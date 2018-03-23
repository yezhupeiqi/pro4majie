<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/12
 * Time: 15:38
 */

class Control
{
    public function doaction($cont){
        //判断是否有该方法
        if(method_exists($this,$cont)){
            $this->$cont();
        }else{
            $this->show('./view/notfound.php');
        }
    }
    //显示页面的方法
    public function show($url,$data=null){
        include_once $url;
    }
}