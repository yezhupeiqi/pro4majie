<?php

class havepayModel extends Modle
{
    public function getOrder(){
        $sql="select * from t_order WHERE status='已支付' or status='已发货' or status='交易成功'";
        $count=$this->getNaxdata($sql);
        $page=new Page($count[0]['count'],5,'./index.php?a=havepay&c=showOrder');
        $sql="select * from t_order WHERE status='已支付' or status='已发货' or status='交易成功' ORDER BY ordertime DESC limit {$page->getStart()},{$page->getOne()}";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
    public function showpage(){
        $sql="select count(*) as count from t_order WHERE status='已支付' or status='已发货' or status='交易成功'";
        $count=$this->getNaxdata($sql);
        $page=new Page($count[0]['count'],5,'./index.php?a=havepay&c=showOrder');
        $res=$page->getNum();
        return $res;
    }
    //发货
    public function modSta($orderid){
        $sql="UPDATE t_order SET status='已发货' WHERE orderid='{$orderid}'";
        $res=$this->addData($sql);
        return  $res;
    }
    //订单详情
    public function ckeckDetail($orderid){
        $sql="select * FROM t_order a,t_user b,s_merchandise c,t_commodtype d WHERE a.u_id = b.userid AND a.m_id = c.s_mcsid AND c.s_typeid=d.typeid AND a.orderid={$orderid}";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
}