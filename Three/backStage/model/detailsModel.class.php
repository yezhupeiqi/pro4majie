<?php

class detailsModel extends Modle
{
    //获取商品详情数据
    public function getMcs($mcsid){
        $sql="select * from s_merchandise a,t_commodtype b,t_secondkilltime c WHERE a.s_typeid=b.typeid and a.s_secondid=c.secondid and s_mcsid={$mcsid}";
        $data=$this->getNaxdata($sql);
        return  $data;
    }
}