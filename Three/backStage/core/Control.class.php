<?php

abstract class Contorl{
//    abstract public function docation($a);

    public function show($url,$data=null){
        include_once $url;
    }
}