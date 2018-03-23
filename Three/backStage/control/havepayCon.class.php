<?php

class havepayCon extends Contorl
{
    public function doaction($c){
        if($c == 'showlastpay'){
            $this->showlastpay();
        }
        else if($c == 'showOrder'){
            $this->showOrder();
        }
        else if($c == 'modState'){
            $this->modState();
        }
        else if($c == 'checkTail'){
            $this->checkTail();
        }
    }

    public function showlastpay(){
        $this->show('./view/havepay.html');
    }
    //显示已支付订单
    public function showOrder(){
        $model=new havepayModel();
        $data=$model->getOrder();
        $str=$model->showpage();
        echo json_encode([$data,$str]);
    }
    //发货
    public function modState(){
        $orderid=isset($_POST['id'])?$_POST['id']:"";
        $model=new havepayModel();
        $res=$model->modSta($orderid);
        echo $res;

    }
    //查看订单详情
    public function checkTail(){
        $orderid=isset($_POST['id'])?$_POST['id']:"";
        $model=new nopayModel();
        $data=$model->ckeckDetail($orderid);
        echo json_encode($data);
    }
}