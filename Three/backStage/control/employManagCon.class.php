<?php

class employManagCon extends Contorl
{
    public function doaction($c){
        if($c == 'showEmploy'){
            $this->showEmploy();
        }
        else if($c == 'showUser'){
            $this->showUser();
        }
        else if($c == 'showSlect'){
            $this->showSlect();
        }
        else if($c == 'modPwd'){
            $this->modPwd();
        }
        else if($c == 'modState'){
            $this->modState();
        }
    }
    public function showEmploy(){//显示用户也面
        $this->show('./view/employManag.php');
    }
    //显示用户表
    public function showUser(){
        $model=new employModel();
        $data=$model->getUserInfo();
        $str=$model->showpage();
        echo json_encode([$data,$str]);
    }
    //查找显示
    public function showSlect(){
        $angls=json_decode(file_get_contents('php://input'),true);
        $name=isset($angls['name'])?$angls['name']:"";
        $model=new employModel();
        $data=$model->selectUser($name);
        $str=$model->selecyPage($name);
        echo json_encode([$data,$str]);
    }
    //重置密码
    public function modPwd(){
        $userid=isset($_POST['id'])?$_POST['id']:"";
        $model=new employModel();
        $data=$model->getUser($userid);
        $state=$data[0]['state'];
        if($state != '锁定'){
            $res=$model->resetPwd($userid);
            echo $res;
        }
        else{
            echo 'no';
        }
    }
    //修改状态
    public function modState(){
        $array=isset($_POST['arr'])?$_POST['arr']:"";
        $idArr=json_decode($array);
        $model=new employModel();
        foreach ($idArr as $val){
            $data=$model->getF($val);
            if($data[0]["state"] == '锁定'){
                $res=$model->modSta($val);
            }
            else if($data[0]["state"] == '使用'){
                $res=$model-> modTate($val);

            }
        }
        echo $res;
    }

}