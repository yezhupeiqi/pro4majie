<?php

class roleModel extends Modle
{
    public function getSole(){
        $data=$this->simSelect(role);
        return  $data;
    }
    //添加角色
    public function addR($r_name,$ribe){
        $sql="INSERT INTO role(r_name,ribe)VALUES('{$r_name}','{$ribe}')";
        $data=$this->addData($sql);
        return  $data;
    }
    //查找对应角色
    public function role($r_id){
        $condition=['r_id'=>$r_id];
        $data=$this->selectWhere(role,$condition);
        return  $data;
    }
    //查找对应角色
    public function roleParts($r_id){
        $condition=['role_id'=>$r_id];
        $data=$this->selectWhere(roleParts,$condition);
        return  $data;
    }
    //修改角色名称
    public function upSoleName($r_id,$r_name){
        $sql="UPDATE role SET r_name='{$r_name}' WHERE r_id='{$r_id}'";
        $data=$this->addData($sql);
        return  $data;
    }
    //修改角色描述
    public function upSoleribe($r_id,$ribe){
        $sql="UPDATE role SET ribe='{$ribe}' WHERE r_id='{$r_id}'";
        $data=$this->addData($sql);
        return  $data;
    }
    //删除角色
    public function deletR($r_id){
        $sql="delete from role WHERE r_id='{$r_id}'";
        $data=$this->addData($sql);
        return  $data;
    }
    //删除角色权限
    public function deleRolePart($r_id){
        $sql="delete from roleParts WHERE role_id='{$r_id}'";
        $res=$this->addData($sql);
        return  $res;
    }
    //插入角色权限
    public function inssetPerm($role_id,$array){
        for($i=0;$i<count($array);$i++){
            $sql="INSERT INTO roleParts(role_id,m_id)VALUES({$role_id},{$array[$i]})";
            $res=$this->addData($sql);
        }
        return 1;
    }

    public function getAccessMenu(){
        $data=$this->simSelect(accessMenu);
        return  $data;
    }



}