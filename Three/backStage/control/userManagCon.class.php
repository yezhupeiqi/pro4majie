<?php

class userManagCon extends Contorl
{
    public function doaction($c){
        if($c == 'showuser'){
            $this->showuser();
        }
        else if($c == 'showSaffe'){
            $this->showSaffe();
        }
        else if($c == 'addStaff'){
            $this->addStaff();
        }
        else if($c == 'deletStaff'){
            $this->deletStaff();
        }
        else if($c == 'showModify'){
            $this->showModify();
        }
        else if($c == 'modId'){
            $this->modId();
        }
        else if($c == 'modName'){
            $this->modName();
        }
        else if($c == 'modRole'){
            $this->modRole();
        }
        else if($c == 'modPwd'){
            $this->modPwd();
        }
        else if($c == 'modState'){
            $this->modState();
        }
        else if($c == 'switchSta'){
            $this->switchSta();
        }
        else if($c == 'roleSelect'){
            $this->roleSelect();
        }
    }
    public function showuser(){//显示用户也面
        $this->show('./view/userManag.html');
    }
    public function showSaffe(){//显示员工表
        $model=new userModel();
        $data=$model->getSaffe();
        echo json_encode($data);
    }
    //添加员工
    public function addStaff(){
        $s_id=isset($_POST['user'])?$_POST['user']:"";
        $s_pwd=isset($_POST['psd'])?$_POST['psd']:"";
        $pwd=md5($s_pwd);
        $s_name=isset($_POST['username'])?$_POST['username']:"";
        $s_role=isset($_POST['roleid'])?$_POST['roleid']:"";
        if($s_id != '' && $s_pwd !=''&& $s_name !=''){
            $model=new userModel();
            $data=$model->addSF($s_id,$pwd,$s_name,$s_role);
            if($data == 'true'){
                echo 'yes';
            }else{
                echo 'no';
            }
        }
        else{
            echo '0';
        }
    }
    //删除员工
    public function deletStaff(){
        $s_id=isset($_POST['id'])?$_POST['id']:"";
        $model=new userModel();
        $data=$model->getS($s_id);
        $state=$data[0]['state'];
        if($state != '锁定'){
            $res=$model->deletS($s_id);
            echo $res;
        }
        else{
            echo '0';
        }
    }
    //显示修改内容
    public function showModify(){
        $s_id=isset($_POST['id'])?$_POST['id']:"";
        $model=new userModel();
        $data=$model->getS($s_id);
        echo json_encode($data);
    }
    //修改用户id
    public function modId(){
        $w_id=isset($_POST['id'])?$_POST['id']:"";
        $s_id=isset($_POST['s_id'])?$_POST['s_id']:"";
        $model=new userModel();
        $data=$model->getS($s_id);
        $state=$data[0]['state'];
        if($state != '锁定'){
            $res=$model->upUserId($s_id,$w_id);
            echo $res;
        }
        else{
            echo '0';
        }

    }
    //修改员工名称
    public function modName(){
        $name=isset($_POST['s_name'])?$_POST['s_name']:"";
        $s_id=isset($_POST['id'])?$_POST['id']:"";
        $model=new userModel();
        $data=$model->getS($s_id);
        $state=$data[0]['state'];
        if($state != '锁定'){
            $res=$model->upUserNname($s_id,$name);
            echo $res;
        }
        else{
            echo '0';
        }

    }
    //修改员工角色
    public function modRole(){
        $roleid=isset($_POST['roleid'])?$_POST['roleid']:"";
        $s_id=isset($_POST['id'])?$_POST['id']:"";
        $model=new userModel();
        $data=$model->getS($s_id);
        $state=$data[0]['state'];
        if($state != '锁定'){
            $res=$model->upUserRole($s_id,$roleid);
            echo $res;
        }
        else{
            echo '0';
        }
    }
    //重置密码
    public function modPwd(){
        $s_id=isset($_POST['id'])?$_POST['id']:"";
        $password=md5(123);
        $model=new userModel();
        $data=$model->getS($s_id);
        $state=$data[0]['state'];
        if($state != '锁定'){
            $res=$model->upUserPwd($s_id,$password);
            echo $res;
        }
        else{
            echo '0';
        }
    }
    //修改状态
    public function modState(){
        $array=isset($_POST['arr'])?$_POST['arr']:"";
        $idArr=json_decode($array);
        $model=new userModel();
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
    //切换状态
    public function switchSta(){
        $state=isset($_POST['state'])?$_POST['state']:"";
        $model=new userModel();
        $data=$model->getStaStaf($state);
        echo json_encode($data);
    }
    //显示下拉框
    public function roleSelect(){
        $model=new userModel();
        $data=$model->getRole();
        echo json_encode($data);
    }
}