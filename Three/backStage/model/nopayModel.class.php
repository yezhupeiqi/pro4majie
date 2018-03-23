<?php

class nopayModel extends Modle
{
    public function getNoOrder(){
        $sql="select * from t_order WHERE status='未支付' or status='交易失败'";
        $count=$this->getNaxdata($sql);
        $page=new Page($count[0]['count'],3,'./index.php?a=nonpay&c=showOrder');
        $sql="select * from t_order WHERE status='未支付' or status='交易失败' ORDER BY ordertime DESC limit {$page->getStart()},{$page->getOne()}";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    public function showpage(){
        $sql="select count(*) as count from t_order WHERE status='未支付' or status='交易失败'";
        $count=$this->getNaxdata($sql);
        $page=new Page($count[0]['count'],3,'./index.php?a=nonpay&c=showOrder');
        $res=$page->getNum();
        return $res;
    }
    //订单详情
    public function ckeckDetail($orderid){
        $sql="select * FROM t_order a,t_user b,s_merchandise c,t_commodtype d WHERE a.u_id = b.userid AND a.m_id = c.s_mcsid AND c.s_typeid=d.typeid AND a.orderid={$orderid}";
        $data=$this->getNaxdata($sql);
        return  $data;
    }

}