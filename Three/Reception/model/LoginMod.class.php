<?php

//require_once "./core/Model.class.php";
class LoginMod extends Model
{
    public function login($id,$pwd){
        $condition = ['id'=>$id,'password'=>md5($pwd)];
        $res = $this->selectWhere(teacher,$condition);
        return $res;
    }
    public function getMenu(){
        $res = $this->selectAll(menu);
        return $res;
    }
}