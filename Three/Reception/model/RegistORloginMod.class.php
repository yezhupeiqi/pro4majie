<?php
require_once "./core/Model.class.php";
class RegistORloginMod extends Model
{
    //获取普通商品且上架商品的分页信息
    public function getGoodsByPage($start,$end){
        $sql = "select * from s_merchandise WHERE s_mcsState = '上架' and s_publishType = '普通' limit $start,$end";
        $data = $this->mysqli->sqlQuery($sql);
        $this->saveSqlOper($sql);
        return $data;
    }
    //获取前6条支付成功的订单信息
    public function getHonorForSix(){
        $sql = "select u_id,mcsname from t_order ORDER  BY orderid DESC limit 6";
        $data = $this->mysqli->sqlQuery($sql);
        $this->saveSqlOper($sql);
        return $data;
    }
    //判断余额
    public function judgmentMoney($userid,$money){
        $sql = "select balance AS money from t_user WHERE userid = $userid and $money <= balance";
        $data = $this->mysqli->sqlQuery($sql);
        $this->saveSqlOper($sql);
        return $data;
    }
}