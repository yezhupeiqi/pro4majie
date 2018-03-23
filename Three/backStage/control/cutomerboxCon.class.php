<?php

class cutomerboxCon extends Contorl
{
    public function doaction($c){
        if($c == 'showBox'){
            $this->showBox();
        }
        else if($c == 'sendData'){
            $this->sendData();
        }

    }

    public function showBox (){
        $this->show('./view/cutomerbox.html');
    }
    //获取客服Id
    public function sendData(){
        $saffid=$_COOKIE['lineid'];
        $model=new cutomerboxModel();
        $data=$model->getSaffe();
        echo json_encode([$saffid,$data]);
    }


}