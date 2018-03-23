<?php
require_once "./core/Control.class.php";
class HomepageCon extends Control
{
    //显示主页
    public function homepage(){
        $this->show('./view/homepage.php');
    }
    //获取分页商品信息
    public function getGoods(){
        $model = new  RegistORloginMod();
        $condition = ['s_mcsState'=>'上架','s_publishType'=>'普通'];
        //获取商品总条数
        $res = $model->getCount('s_merchandise',$condition);
        $allRows = $res[0]['allCount'];
        //获取分页商品信息
        $page = new SplitPage($allRows,4,'');
        $start = $page->startPage();
        $end = $page->onePage();
        $res1 = $model->getGoodsByPage($start,$end);
        //商品信息
        $arr=array('goodsData'=>$res1);
        //分页信息
        $arr['pageInfo'] = $page->getPage();
        echo json_encode($arr);
    }
    //获取荣誉墙信息
    public function getHonor(){
        $model = new  RegistORloginMod();//new 一个查询模块
        $res = $model->getHonorForSix();
        if(!empty($res)){
            echo json_encode($res);
        }else{
            echo 0;
        }
    }
    //显示商品详情页
    public function showDetail(){
        $s_mcsid = isset($_GET['goodsid'])?$_GET['goodsid']:0;
        if($s_mcsid == 0){
            exit(0);
        }
        $model = new RegistORloginMod();
        $condition = ['s_mcsid'=>$s_mcsid];
        $res = $model->queryData(s_merchandise,$condition);
        $this->show('./view/comDetails.php',$res);
    }
    //个人中心
    public function showInfo(){
        session_start();
        $userid = isset($_SESSION['userid'])?$_SESSION['userid']:0;
        if($userid == 0){
            echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body><script src='./view/jquery-ui-1.12.1.custom/external/jquery/jquery.js' type='text/javascript'></script><script type='text/javascript' src='./view/js/plug-in.js'></script>
                      <script type='text/javascript'>$.Pop('当前还未登录，请先登录后再进行操作','alert',function() {
                            window.location.href='./index.php?c=Main&a=showMain';
                      })</script>
                    </body>";
        }else{
            $model = new RegistORloginMod();
            $condition = ['userid'=>$userid];
            $res = $model->queryData(t_user,$condition);
            $this->show('./view/infomation.php',$res);
        }
    }
    //充值
    public function recharge(){
        session_start();
        $userid = $_SESSION['userid'];
        $money = $_POST['money'];
        $new = ['balance'=>$money];
        $condition = ['userid'=>$userid];
        $model = new RegistORloginMod();
        $res = $model->updateData(t_user,$new,$condition);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }
    //购买商品
    public function buyGoods(){
        session_start();
        $userid = $_SESSION['userid'];
        $money = $_POST['money'];
        $model = new RegistORloginMod();
        //判断余额是否充足
        $res1 = $model->judgmentMoney($userid,$money);
        if(empty($res1)){
            echo 0;//余额不足
            $goodsid = $_POST['goodsid'];
            $goodsimg = $_POST['goodsimg'];
            $goodsname = $_POST['goodsname'];
            $ordertime = date("Y-m-d H:i:s");
            //生成已支付订单
            $new = ['u_id'=>$userid,'m_id'=>$goodsid,'mcsimg'=>$goodsimg,'mcsname'=>$goodsname,'price'=>$money,'status'=>'未支付','ordertime'=>$ordertime];
            $res = $model->insertData(t_order,$new);
        }else{
            $blance =  $res1[0]['money'];
            $goodsid = $_POST['goodsid'];
            $goodsimg = $_POST['goodsimg'];
            $goodsname = $_POST['goodsname'];
            $ordertime = date("Y-m-d H:i:s");
            //生成已支付订单
            $new = ['u_id'=>$userid,'m_id'=>$goodsid,'mcsimg'=>$goodsimg,'mcsname'=>$goodsname,'price'=>$money,'status'=>'已支付','ordertime'=>$ordertime];
            $res = $model->insertData(t_order,$new);
            //减少用户余额
            $blance = $blance-$money;
            $new2 = ['balance'=>$blance];
            $con2 = ['userid'=>$userid];
            $res2 = $model->updateData(t_user,$new2,$con2);
            //减少库存
            $s_surplus = $_POST['num'];
            $new3 = ['s_surplus'=>$s_surplus];
            $condition3 = ['s_mcsid'=>$goodsid];
            $res3 = $model->updateData(s_merchandise,$new3,$condition3);
            echo 1;
        }
    }
}