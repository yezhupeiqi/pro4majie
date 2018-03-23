<?php

class mcsinformCon extends Contorl
{
    public function doaction($c){
        if($c == 'showMcsPage'){
            $this->showMcsPage();
        }
        else if($c == 'showmcs'){
            $this->showmcs();
        }
        else if($c == 'showType'){
            $this->showType();
        }
        else if($c == 'mcsEditor'){
            $this->mcsEditor();
        }
        else if($c == 'modState'){
            $this->modState();
        }
    }

    public function showMcsPage (){
        $this->show('./view/mcsinfo.php');
    }
    //显示商品
    public function showmcs(){
        $model=new infoModel(); 
        $data=$model->getMcsinfo();
        $str=$model->showpage();
        echo json_encode([$data,$str]);
    }
    //查找显示
    public function showType(){
        $angls=json_decode(file_get_contents('php://input'),true);
        $type=isset($angls['type'])?$angls['type']:"";
        $state=isset($angls['state'])?$angls['state']:"";
        $name=isset($angls['name'])?$angls['name']:"";
        $model=new infoModel();
        $data=$model->selectMcs($type,$state,$name);
        $str=$model->selecyPage($type,$state,$name);
        echo json_encode([$data,$str]);
    }
    //修改状态
    public function modState(){
        $mcsid=isset($_POST['mcsId'])?$_POST['mcsId']:"";
        $state=isset($_POST['state'])?$_POST['state']:"";
        $model=new infoModel();
        $res=$model->modSta($mcsid,$state);
        echo $res;
    }


}