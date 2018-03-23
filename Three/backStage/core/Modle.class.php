<?php


class Modle
{
    //数据库连接
    protected $db;

    public function __construct()
    {
    	include ('./config/config.php');
        require_once ('./public/Database.class.php');
        $this->db=Database::createDB($config);

    }
    //简单的查询语句封装
    public function simSelect($table){
        $sql="select * from {$table}";
        $data=$this->db->querySql($sql);
        return $data;
    }
    //带条件语句查询
    public function selectWhere($table,$condition){
        $sql="select * from {$table} WHERE 1=1";
        foreach ($condition as $key=>$value){
            $sql.=" and {$key}='{$value}'";
        }
        $data=$this->db->querySql($sql);
        return $data;
    }
    //删除
    public function deletWhere($table,$condition){
        $sql="delete from {$table} WHERE 1=1";
        foreach ($condition as $key=>$value){
            $sql.=" and {$key}='{$value}'";
        }
        $res=$this->db->performSql($sql);
        return $res;
    }
    public function getNaxdata($sql){//多表查询
        $data=$this->db->querySql($sql);
        return $data;
    }
    public function addData($sql){//插入数据
        $data=$this->db->performSql($sql);
        return $data;
    }
    //分页
    public function count($table){
        $sql="select count(*) as count from {$table}";
        $count=$this->db->querySql($sql);
        return $count;
    }
    public function page($table,$page){
        $sql="select * from {$table} limit {$page->getStart()},{$page->getOne()}";
        $data=$this->db->querySql($sql);
        return $data;
    }

}