<?php

class infoModel extends Modle
{
    public function getMcsinfo(){
        $count=$this->count(s_merchandise);
        $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showmcs');
        $sql="select * from s_merchandise ORDER BY s_mcsid limit {$page->getStart()},{$page->getOne()}";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    public function showpage(){
        $count=$this->count(s_merchandise);
        $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showmcs');
        $res=$page->getNum();
        return $res;
    }
    //查找
    public function selectMcs($type,$state,$name){
        if($state != ''&&$type == ''){
            $sql="select count(*) as count from s_merchandise WHERE s_mcsState='{$state}' and s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $sql2="select * from s_merchandise  WHERE s_mcsState='{$state}' and s_mcsidname like '%{$name}%' ORDER BY s_mcsid limit {$page->getStart()},{$page->getOne()}";
            $data=$this->getNaxdata($sql2);
            return  $data;
        }
        else if($type != ''&&$state == ''){
            $sql="select count(*) as count from s_merchandise a INNER JOIN t_commodtype b on a.s_typeid=b.typeid and a.s_typeid={$type} and a.s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $sql2="select * from s_merchandise a INNER JOIN t_commodtype b on a.s_typeid=b.typeid and a.s_typeid={$type} and a.s_mcsidname like '%{$name}%' ORDER BY s_mcsid limit {$page->getStart()},{$page->getOne()}";
            $data=$this->getNaxdata($sql2);
            return  $data;
        }
        else if($type != ''&&$state != ''){
            $sql="select count(*) as count from s_merchandise a INNER JOIN t_commodtype b on a.s_typeid=b.typeid and a.s_typeid={$type} and a.s_mcsState='{$state}' and a.s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $sql2="select * from s_merchandise a INNER JOIN t_commodtype b on a.s_typeid=b.typeid and a.s_typeid={$type} and a.s_mcsState='{$state}' and a.s_mcsidname like '%{$name}%' ORDER BY s_mcsid limit {$page->getStart()},{$page->getOne()}";
            $data=$this->getNaxdata($sql2);
            return  $data;
        }
        else if($type == ''&&$state == ''){
            $sql="select count(*) as count from s_merchandise WHERE s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $sql2="select * from s_merchandise WHERE s_mcsidname like '%{$name}%' ORDER BY s_mcsid limit {$page->getStart()},{$page->getOne()}";
            $data=$this->getNaxdata($sql2);
            return  $data;
        }
    }
    //分页
    public function selecyPage($type,$state,$name){
        if($state != ''&&$type == ''){
            $sql="select count(*) as count from s_merchandise WHERE s_mcsState='{$state}' and s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $res=$page->getNum();
            return $res;
        }
        else if($type != ''&&$state == ''){
            $sql="select count(*) as count from s_merchandise a INNER JOIN t_commodtype b on a.s_typeid=b.typeid and a.s_typeid={$type} and a.s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $res=$page->getNum();
            return $res;
        }
        else if($type != ''&&$state != ''){
            $sql="select count(*) as count from s_merchandise a INNER JOIN t_commodtype b on a.s_typeid=b.typeid and a.s_typeid={$type} and a.s_mcsState='{$state}' and a.s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $res=$page->getNum();
            return $res;
        }
        else if($type == ''&&$state == ''){
            $sql="select count(*) as count from s_merchandise WHERE s_mcsidname like '%{$name}%'";
            $count=$this->getNaxdata($sql);
            $page=new Page($count[0]['count'],3,'./index.php?a=mcsinform&c=showType');
            $res=$page->getNum();
            return $res;
        }
    }
    public function modSta($mcsid,$state){
        if($state == '下架'){
            $sql="UPDATE s_merchandise SET s_mcsState='下架' WHERE s_mcsid={$mcsid}";
            $res=$this->addData($sql);
            return $res;
        }
        else if($state == '上架'){
            $sql="UPDATE s_merchandise SET s_mcsState='上架',s_shelves=NOW() WHERE s_mcsid={$mcsid}";
            $res=$this->addData($sql);
            return $res;
        }
        else if($state == '未上架'){
            $sql="UPDATE s_merchandise SET s_mcsState='上架',s_shelves=NOW() WHERE s_mcsid={$mcsid}";
            $res=$this->addData($sql);
            return $res;
        }

    }


}