<?php

class nonpayCon extends Contorl
{
    public function doaction($c){
        if($c == 'shownopay'){
            $this->shownopay();
        }
        else if($c == 'showOrder'){
            $this->showOrder();
        }
        else if($c == 'checkTail'){
            $this->checkTail();
        }
    }

    public function shownopay(){
        $this->show('./view/nonpay.html');
    }
    //显示未支付订单
    public function showOrder(){
        $model=new nopayModel();
        $data=$model->getNoOrder();
        $str=$model->showpage();
        echo json_encode([$data,$str]);
    }
    //查看订单详情
    public function checkTail(){
        $orderid=isset($_POST['id'])?$_POST['id']:"";
        $model=new nopayModel();
        $data=$model->ckeckDetail($orderid);
        echo json_encode($data);
    }
}