<?php

class LoginModel extends Modle
{
	//登陆
    public function loginM($user,$password){
        $condition=['s_id'=>$user,'s_pwd'=>$password];
        $data=$this->selectWhere(staff,$condition);
        return  $data;
    }
    //获取员工
    public function getStaff($uid){
        $condition=['s_id'=>$uid];
        $data=$this->selectWhere(staff,$condition);
        return  $data;
    }
    //获取角色分配
    public function getParts($roleid){
        $condition=['role_id'=>$roleid];
        $data=$this->selectWhere(roleParts,$condition);
        return  $data;
    }
    //获取权限菜单
    public function getMenu(){
        $data=$this->simSelect(accessMenu);
        return  $data;
    }
    public function getSchool(){
        $data=$this->simSelect(school);
        return  $data;
    }
    public function getColleges($s_id){
        $condition=['sid'=>$s_id];
        $data=$this->selectWhere(school,$condition);
        return  $data;
    }
    public function getUser($id){
        $sql="select * FROM staff a INNER JOIN role b on a.s_role = b.r_id AND a.s_id='$id';";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
}