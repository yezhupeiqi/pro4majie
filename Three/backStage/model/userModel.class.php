<?php

class userModel extends Modle
{
    public function getSaffe(){
        $sql="select * FROM staff a INNER JOIN role b on a.s_role = b.r_id";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    public function addSF($s_id,$pwd,$s_name,$s_role){//添加员工
        $sql="INSERT INTO staff(s_id,s_pwd,s_name,s_role,state)VALUES('{$s_id}','{$pwd}','{$s_name}',{$s_role},'使用')";
        $data=$this->addData($sql);
        return  $data;
    }
    //获取员工信息
    public function getS($s_id){
        $sql="select * FROM staff a INNER JOIN role b on a.s_role = b.r_id WHERE a.s_id='{$s_id}'";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    //删除员工
    public function deletS($s_id){
        $condition=['s_id'=>$s_id];
        $data=$this->deletWhere(staff,$condition);
        return  $data;
    }
    //修改id
    public function upUserId($s_id,$w_id){
        $sql="UPDATE staff SET s_id='{$s_id}' WHERE s_id='{$w_id}'";
        $data=$this->addData($sql);
        return  $data;
    }
    //修改员工名称
    public function upUserNname($s_id,$name){
        $sql="UPDATE staff SET s_role='{$name}' WHERE s_id='{$s_id}'";
        $data=$this->addData($sql);
        return  $data;
    }
    //修改员工角色
    public function upUserRole($s_id,$roleid){
        $sql="UPDATE staff SET s_role='{$roleid}' WHERE s_id='{$s_id}'";
        $data=$this->addData($sql);
        return  $data;
    }
    //重置密码
    public function upUserPwd($s_id,$password){
        $sql="UPDATE staff SET s_pwd='{$password}' WHERE s_id='{$s_id}'";
        $data=$this->addData($sql);
        return  $data;
    }
    //修改状态
    public function getF($val){
        $condition=['s_id'=>$val];
        $data=$this->selectWhere(staff,$condition);
        return  $data;
    }
    public function modSta($val){
        $sql="UPDATE staff SET state='使用' WHERE s_id='{$val}'";
        $res=$this->addData($sql);
        return  $res;
    }
    public function modTate($val){
        $sql="UPDATE staff SET state='锁定' WHERE s_id='{$val}'";
        $res=$this->addData($sql);
        return  $res;
    }
    //切换状态
    public function getStaStaf($state){
        $sql="select * FROM staff a INNER JOIN role b on a.s_role = b.r_id and state='{$state}'";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    //获取角色信息
    public function getRole(){
        $sql="select * FROM role";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
}