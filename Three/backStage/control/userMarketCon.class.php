<?php

class userMarketCon extends Contorl
{
    public function doaction($c){
        if($c == 'showuser'){
            $this->showuser();
        }
        else if($c == 'showMarket'){
            $this->showMarket();
        }
        else if($c == 'getUserData'){
            $this->getUserData();
        }
        else if($c == 'getIndentData'){
            $this->getIndentData();
        }
    }
    public function showuser(){//显示用户报表
        $this->show('./view/userStat.php');
    }
    public function showMarket(){//显示销售表
        $this->show('./view/MarketingStat.php');
    }
    //用户报表
    public function getUserData(){
        $model=new userMarketModel;
        $data=$model->getUser();
        $arr=[0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($data as $key=>$value){
            array_splice($arr,$data[$key]['month']-1,1,$data[$key]['count']);
        }
        echo json_encode($arr);
    }
    //销售报表
    public function getIndentData(){
        $model=new userMarketModel;
        $data=$model->getIndent();
        $arr=[0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($data as $key=>$value){
            array_splice($arr,$data[$key]['month']-1,1,$data[$key]['count']);
        }
        echo json_encode($arr);


    }
}