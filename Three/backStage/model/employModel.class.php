<?php

class employModel extends Modle
{
    public function getUserInfo(){
        $count=$this->count(t_user);
        $page=new Page($count[0]['count'],5,'./index.php?a=employManag&c=showUser');
        $sql="select * from t_user ORDER BY userid limit {$page->getStart()},{$page->getOne()}";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    public function showpage(){
        $count=$this->count(t_user);
        $page=new Page($count[0]['count'],3,'./index.php?a=employManag&c=showUser');
        $res=$page->getNum();
        return $res;
    }
    //查找
    public function selectUser($name){
        $sql="select count(*) as count from t_user WHERE nickname like '%{$name}%'";
        $count=$this->getNaxdata($sql);
        $page=new Page($count[0]['count'],3,'./index.php?a=employManag&c=showType');
        $sql2="select * from t_user WHERE nickname like '%{$name}%' ORDER BY userid DESC limit {$page->getStart()},{$page->getOne()}";
        $data=$this->getNaxdata($sql2);
        return  $data;
    }
    //分页
    public function selecyPage($name){
        $sql="select count(*) as count from t_user WHERE nickname like '%{$name}%'";
        $count=$this->getNaxdata($sql);
        $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
        $res=$page->getNum();
        return $res;
    }
    //获取用户信息
    public function getUser($userid){
        $condition=['userid'=>$userid];
        $data=$this->selectWhere(t_user,$condition);
        return  $data;
    }
    //重置密码
    public function resetPwd($userid){
        $sql="UPDATE t_user SET password=MD5('123') WHERE userid='{$userid}'";
        $res=$this->addData($sql);
        return  $res;
    }
    //修改状态
    public function getF($val){
        $condition=['userid'=>$val];
        $data=$this->selectWhere(t_user,$condition);
        return  $data;
    }
    public function modSta($val){
        $sql="UPDATE t_user SET state='使用' WHERE userid='{$val}'";
        $res=$this->addData($sql);
        return  $res;
    }
    public function modTate($val){
        $sql="UPDATE t_user SET state='锁定' WHERE userid='{$val}'";
        $res=$this->addData($sql);
        return  $res;
    }

}