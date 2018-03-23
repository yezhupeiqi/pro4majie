<?php

class userMarketModel extends Modle
{
    public function getUser(){
        $sql="select count(*) as count,MONTH(registime) as month FROM t_user GROUP BY MONTH(registime)";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    public function getIndent(){
        $sql="select count(*) as count,MONTH(ordertime) as month FROM t_order WHERE status='交易成功' GROUP BY MONTH(ordertime)";
        $data=$this->getNaxdata($sql);
        return  $data;
    }

}